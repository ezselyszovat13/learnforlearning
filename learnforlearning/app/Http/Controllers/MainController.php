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
        $commentCount = 0;

        User::all()->each(function ($user) use (&$data, &$comments, &$commentCount) {
            $data = $data + $user->subjects()->count();
            $userComments = $user->votes()->get();
            foreach($userComments as $userComment){
                if($userComment !== null && $userComment->pivot->comment !== null){
                    $teacher = Teacher::where('id',$userComment->pivot->teacher_id)->first();
                    $comment = [
                        'author' => $user->name,
                        'teacher' => $teacher->name,
                        'comment' => $userComment->pivot->comment
                    ];
                    if($commentCount < 5) array_push($comments,$comment);
                    $commentCount += 1;
                    break;
                }
            }
        });

        $bestTeacher = Teacher::all()->first()->name;
        $maxPoints = 0;

        Teacher::all()->where('is_accepted',true)->each(function ($teacher) use (&$bestTeacher, &$maxPoints) {
            $voters = $teacher->voters()->get(); 
            $voterPoints = 0;
            foreach($voters as $voter){
                $vote = $voter->pivot->is_positive_vote;
                if($vote !== null){
                    if($vote)
                        $voterPoints += 1;
                    else
                        $voterPoints -= 1;
                }
            }  
            if($voterPoints > $maxPoints){
                $bestTeacher = $teacher->name;
                $maxPoints = $voterPoints;
            }
        });

        return view('main', compact('users','data','comments','bestTeacher'));
    }

    public function showFixables(){
        $subjects = Subject::where('is_accepted',true)->get();
        $teachers = Teacher::where('is_accepted',true)->get();
        return view('fixable', compact('subjects','teachers'));
    }

    public function goAgainst(ChangeActivityFormRequest $request){
        $data = $request->all();
        $teacher = Teacher::where('id',$data['teacher'])->first();
        $isActive = $request->has('is_active');
        $result = $teacher->increaseGoingAgainst($data['subject'],$isActive);
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
        $existsOnA = $request->has('existsA');
        $existsOnB = $request->has('existsB');
        $existsOnC = $request->has('existsC');
        $optionalOnA = $request->has('optionalA');
        $optionalOnB = $request->has('optionalB');
        $optionalOnC = $request->has('optionalC');
        $evenSemester = $request->has('evenSemester');
        $credit = $data['credit'];
        $url = $data['url'];
        Subject::create(['name' => $name, 'code' => $code, 'existsOnA' => $existsOnA, 'existsOnB' => $existsOnB, 'existsOnC' => $existsOnC,
                         'optionalOnA' => $optionalOnA, 'optionalOnB' => $optionalOnB, 'optionalOnC' => $optionalOnC, 'even_semester' => $evenSemester, 'credit_points' => $credit,
                         'url' => $url, 'is_accepted' => false]);
        return redirect()->route('fixable')->with('subject_recommend_added', true);
    }

    public function showRequests(){
        $activitySubjects = [];
        Teacher::all()->where('is_accepted',true)->each(function ($teacher) use (&$activitySubjects) {
            $subjects = $teacher->subjects()->get();
            foreach($subjects as $subject){
                if($subject->pivot->going_against > 0){
                    $newSubject = [
                        'teacher' => $teacher,
                        'subjectId' => $subject->id,
                        'subjectName' => $subject->name,
                        'isActive' => $subject->pivot->is_active,
                        'goingAgainst' => $subject->pivot->going_against
                    ];
                    array_push($activitySubjects,$newSubject);
                }
            }
        });
        $pendingTeachers = [];
        Teacher::all()->each(function ($teacher) use (&$pendingTeachers) {
            if(!$teacher->is_accepted)
                array_push($pendingTeachers,$teacher);
        });
        $pendingSubjects = [];
        Subject::all()->each(function ($subject) use (&$pendingSubjects) {
            if(!$subject->is_accepted)
                array_push($pendingSubjects,$subject);
        });
        return view('manage',compact('activitySubjects','pendingTeachers','pendingSubjects'));
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
        $teacher->setAccepted(true);
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
        $subject->setAccepted(true);
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
