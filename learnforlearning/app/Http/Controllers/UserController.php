<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use Auth;
use App\Http\Requests\ModifySpecFormRequest;
use App\Http\Requests\AddCommentFormRequest;

class UserController extends Controller
{
    public function show() {
        $user = Auth::user();
        return view('personal',compact('user'));
    }

    public function editSpecialization(){
        $user = Auth::User();
        $oldSpec = $user['spec'];
        return view('edit-specialization', compact('user','oldSpec'));
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
        $user->vote($params['teacherId'],$params['isPositive']);
        return redirect()->route('subjects.info', ['id' => $params['subjectId']]);
    }

    public function comment(Request $request){
        $params = $request->all();
        $teacher = Teacher::where('id', $params['teacherId'])->first();
        $subject = Subject::where('id', $params['subjectId'])->first();
        if($subject === null){
            return redirect()->route('subjects')->with('subject_not_found', true);
        }
        if($teacher === null){
            return redirect()->route('subjects')->with('teacher_not_found', true);
        }
        $user = Auth::user();
        $connection = $user->votes()->where('teacher_id',$teacher->id)->first();
        if($connection === null){
            return view('make-comment', compact('teacher', 'subject'));
        }
        $comment = $connection->pivot->comment;
        return view('make-comment', compact('teacher', 'subject', 'comment'));
    }

    public function commentUpdate(AddCommentFormRequest $formRequest/*, Request $request*/){
        $data = $formRequest->all();
        $teacher = Teacher::where('id', $data['teacherId'])->first();
        $subject = Subject::where('id', $data['subjectId'])->first();
        if($subject === null){
            return redirect()->route('subjects')->with('subject_not_found', true);
        }
        if($teacher === null){
            return redirect()->route('subjects')->with('teacher_not_found', true);
        }
        $user = Auth::user();
        $user->addComment($teacher->id,$data['comment']);
        return redirect()->route('subjects.info', ['id' => $data['subjectId']])->with('comment_added',true);
    }
}
