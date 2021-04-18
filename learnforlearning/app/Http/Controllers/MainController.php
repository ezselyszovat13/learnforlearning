<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use Auth;
use App\Http\Requests\ChangeActivityFormRequest;
use App\Http\Requests\AddTeacherFormRequest;
use App\Http\Requests\AddSubjectFormRequest;

class MainController extends Controller
{
    public function index() {
        $users = User::count();

        $data = 0;
        $comments = [];
        $comment_count = 0;

        User::all()->each(function ($user) use (&$data, &$comments, &$comment_count) {
            $data = $data + $user->subjects()->count();
            $user_comments = $user->votes()->get();
            foreach($user_comments as $user_comment){
                if($user_comment !== null && $user_comment->pivot->comment !== null){
                    $teacher = Teacher::where('id',$user_comment->pivot->teacher_id)->first();
                    $comment = [
                        'author' => $user->name,
                        'teacher' => $teacher->name,
                        'comment' => $user_comment->pivot->comment
                    ];
                    if($comment_count < 5) array_push($comments,$comment);
                    $comment_count += 1;
                    break;
                }
            }
        });

        $best_teacher = Teacher::all()->first()->name;
        $max_points = 0;

        Teacher::all()->where('is_accepted',true)->each(function ($teacher) use (&$best_teacher, &$max_points) {
            $voters = $teacher->voters()->get(); 
            $voter_points = 0;
            foreach($voters as $voter){
                $vote = $voter->pivot->is_positive_vote;
                if($vote !== null){
                    if($vote)
                        $voter_points += 1;
                    else
                        $voter_points -= 1;
                }
            }  
            if($voter_points > $max_points){
                $best_teacher = $teacher->name;
                $max_points = $voter_points;
            }
        });

        return view('main', compact('users','data','comments','best_teacher'));
    }

    public function showFixables(){
        $subjects = Subject::where('is_accepted',true)->get();
        $teachers = Teacher::where('is_accepted',true)->get();
        return view('fixable', compact('subjects','teachers'));
    }

    public function goAgainst(ChangeActivityFormRequest $request){
        $data = $request->all();
        $teacher = Teacher::where('id',$data['teacher'])->first();
        $is_active = $request->has('is_active');
        $result = $teacher->increaseGoingAgainst($data['subject'],$is_active);
        if($result === null){
            return redirect()->route('fixable')->with('activity_changed', false);
        }
        return redirect()->route('fixable')->with('activity_changed', true);
    }

    public function recommendTeacher(AddTeacherFormRequest $request){
        $data = $request->all();
        $teacher = Teacher::create(['name' => $data['tname'], 'is_accepted' => false]);
        $result = $teacher->setActivity($data['subject2'],false);
        if($result === null){
            return redirect()->route('fixable')->with('teacher_recommend_added', false);
        }
        return redirect()->route('fixable')->with('teacher_recommend_added', true);
    }

    public function recommendSubject(AddSubjectFormRequest $request){
        $data = $request->all();
        $name = $data['sname'];
        $code = $data['code'];
        $exists_on_a = $request->has('existsA');
        $exists_on_b = $request->has('existsB');
        $exists_on_c = $request->has('existsC');
        $optional_on_a = $request->has('optionalA');
        $optional_on_b = $request->has('optionalB');
        $optional_on_c = $request->has('optionalC');
        $even_semester = $request->has('evenSemester');
        $credit = $data['credit'];
        $url = $data['url'];
        Subject::create(['name' => $name, 'code' => $code, 'existsOnA' => $exists_on_a, 'existsOnB' => $exists_on_b, 'existsOnC' => $exists_on_c,
                         'optionalOnA' => $optional_on_a, 'optionalOnB' => $optional_on_b, 'optionalOnC' => $optional_on_c, 'even_semester' => $even_semester, 'credit_points' => $credit,
                         'url' => $url, 'is_accepted' => false]);
        return redirect()->route('fixable')->with('subject_recommend_added', true);
    }

    public function showRequests(){
        $activity_subjects = [];
        Teacher::all()->where('is_accepted',true)->each(function ($teacher) use (&$activity_subjects) {
            $subjects = $teacher->subjects()->get();
            foreach($subjects as $subject){
                if($subject->pivot->going_against > 0){
                    $new_subject = [
                        'teacher' => $teacher,
                        'subjectId' => $subject->id,
                        'subjectName' => $subject->name,
                        'isActive' => $subject->pivot->is_active,
                        'goingAgainst' => $subject->pivot->going_against
                    ];
                    array_push($activity_subjects,$new_subject);
                }
            }
        });
        $pending_teachers = [];
        Teacher::all()->each(function ($teacher) use (&$pending_teachers) {
            if(!$teacher->is_accepted)
                array_push($pending_teachers,$teacher);
        });
        $pending_subjects = [];
        Subject::all()->each(function ($subject) use (&$pending_subjects) {
            if(!$subject->is_accepted)
                array_push($pending_subjects,$subject);
        });
        return view('manage',compact('activity_subjects','pending_teachers','pending_subjects'));
    }

    public function changeTeacherActivity(Request $request){
        $data = $request->all();
        $teacher = Teacher::where('id',$data['teacherId'])->first();
        if($teacher === null){
            return redirect()->route('manage')->with('teacher_not_exists', true);
        }
        $subject = Subject::where('id',$data['subjectId'])->first();
        if($subject === null){
            return redirect()->route('manage')->with('subject_not_exists', true);
        }
        $result = $teacher->setActivity($data['subjectId'],$data['activity']);
        if($result === null){
            return redirect()->route('manage')->with('activity_changed', false);
        }
        return redirect()->route('manage')->with('activity_changed', true);
    }

    public function addTeacher(Request $request){
        $data = $request->all();
        $teacher = Teacher::where('id',$data['teacherId'])->first();
        if($teacher === null){
            return redirect()->route('manage')->with('teacher_not_exists_add', true);
        }
        $teacher->setAccepted();
        $subjects = $teacher->subjects()->get();
        foreach($subjects as $subject){
            $teacher->setActivity($subject->id,true);
        }
        return redirect()->route('manage')->with('teacher_accepted', true);
    }

    public function addSubject(Request $request){
        $data = $request->all();
        $subject = Subject::where('id',$data['subjectId'])->first();
        if($subject === null){
            return redirect()->route('manage')->with('subject_not_exists_add', true);
        }
        $subject->setAccepted();
        return redirect()->route('manage')->with('subject_accepted', true);
    }

    public function resetAgainstActivity(Request $request){
        $data = $request->all();
        $teacher = Teacher::where('id',$data['teacherId'])->first();
        if($teacher === null){
            return redirect()->route('manage')->with('teacher_not_exists', true);
        }
        $subject = Subject::where('id',$data['subjectId'])->first();
        if($subject === null){
            return redirect()->route('manage')->with('subject_not_exists', true);
        }
        $result = $teacher->resetGoingAgainst($data['subjectId']);
        return redirect()->route('manage')->with('activity_change_declined', true);
    }

    public function deleteTeacher(Request $request){
        $data = $request->all();
        $teacher = Teacher::where('id',$data['teacherId'])->first();
        if($teacher === null){
            return redirect()->route('manage')->with('teacher_not_exists_delete', true);
        }
        $teacher->delete();
        return redirect()->route('manage')->with('teacher_deleted', true);
    }

    public function deleteSubject(Request $request){
        $data = $request->all();
        $subject = Subject::where('id',$data['subjectId'])->first();
        if($subject === null){
            return redirect()->route('manage')->with('subject_not_exists_delete', true);
        }
        $subject->delete();
        return redirect()->route('manage')->with('subject_deleted', true);
    }
}
