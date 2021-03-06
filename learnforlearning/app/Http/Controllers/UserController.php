<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use Auth;
use App\Http\Requests\ModifySpecFormRequest;
use App\Http\Requests\AddCommentFormRequest;
use App\Http\Requests\UpdateCommentFormRequest;

class UserController extends Controller
{
    public function show() {
        $user = Auth::user();
        $comments = $user->comments();
        $was_comment = false;
        $was_like = false;
        foreach($comments as $comment){
            if($comment['comment'] !== null)
                $was_comment = true;

            if($comment['is_positive_vote'] !== null)
                $was_like = true;

            if($was_comment && $was_like)
                break;
        }
        return view('personal',compact('user','comments', 'was_comment', 'was_like'));
    }

    public function editSpecialization($id){
        $user = Auth::User();
        if((int)$id !== $user->id)
            return redirect()->route('personal')->with('user_cannot_be_edited', true);
        $old_spec = $user['spec'];
        return view('edit_specialization', compact('user','old_spec'));
    }

    public function updateSpecialization(ModifySpecFormRequest $request, $id){
        $data = $request->all();
        $user = Auth::User();
        $user->update($data);
        return redirect()->route('personal')->with('spec_updated', true);
    }

    public function deleteCalculations(){
        $user = Auth::User();
        $user->deleteOldCalculations();
        return redirect()->route('findsubject')->with('calculations_deleted',true);
    }

    public function vote(Request $request){
        $params = $request->all();
        $user = Auth::user();
        $user_vote = $user->vote($params['teacherId'],$params['isPositive']);
        if($user_vote === null){
            $result = [
                'is_successful' => false,
            ];
            return $result;
        }
        if($user_vote === 4){
            $result = [
                'is_successful' => true,
                'state' => $params['isPositive']
            ];
        }
        else if($user_vote === 2 || $user_vote === 3){
            $result = [
                'is_successful' => true,
                'state' => 'refresh'
            ];
        }
        else{
            $result = [
                'is_successful' => false,
            ];
        }
        return $result;
    }

    public function comment(Request $request){
        $params = $request->all();
        $teacher = Teacher::where('id', $params['teacherId'])->first();
        $subject = Subject::where('id', $params['subjectId'])->first();
        
        $page = null;
        if($request->has('page'))
            $page = $params['page'];

        if($subject === null){
            return redirect()->route('subjects')->with('subject_not_found', true);
        }
        if($teacher === null){
            return redirect()->route('subjects')->with('teacher_not_found', true);
        }
        $user = Auth::user();
        $connection = $user->votes()->where('teacher_id',$teacher->id)->first();
        if($connection === null){
            return view('make_comment', compact('teacher', 'subject', 'page'));
        }
        $comment = $connection->pivot->comment;
        return view('make_comment', compact('teacher', 'subject', 'comment', 'page'));
    }

    public function commentUpdate(AddCommentFormRequest $form_request){
        $data = $form_request->all();
        $teacher = Teacher::where('id', $data['teacherId'])->first();
        $subject = Subject::where('id', $data['subjectId'])->first();

        $page = null;
        if($form_request->has('page'))
            $page = $data['page'];

        if($subject === null){
            return redirect()->route('subjects')->with('subject_not_found', true);
        }
        if($teacher === null){
            return redirect()->route('subjects')->with('teacher_not_found', true);
        }
        $user = Auth::user();
        $user->addComment($teacher->id,$data['comment']);
        return redirect()->route('subjects.info', ['id' => $data['subjectId'], 'page' => $page])->with('comment_added',true);
    }

    public function deleteComment(Request $request){
        $params = $request->all();
        $page = null;
        if($request->has('page'))
            $page = $params['page'];
        $user = Auth::user();
        $result = $user->deleteComment($params['teacherId']);
        if($result === null)
            return redirect()->route('subjects.info', ['id' => $params['subjectId'], 'page' => $page])->with('comment_deleted',false);
        return redirect()->route('subjects.info', ['id' => $params['subjectId'], 'page' => $page])->with('comment_deleted',true);
    }

    public function personalDeleteComment(Request $request){
        $params = $request->all();
        $user = Auth::user();
        $result = $user->deleteComment($params['teacherId']);
        if($result === null)
            return redirect()->route('personal')->with('comment_deleted',false);
        return redirect()->route('personal')->with('comment_deleted',true);
    }
}
