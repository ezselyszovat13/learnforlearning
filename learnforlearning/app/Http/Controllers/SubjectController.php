<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Calculation;
use App\Http\Requests\AddGradeFormRequest;
use App\Http\Requests\ModifyGradeFormRequest;
use Auth;

class SubjectController extends Controller
{
    public function showAll() {
        $subjects = Subject::where('is_accepted',true)->get();
        return view('subjects', compact('subjects'));
    }

    public function showSubject($id, Request $request) {
        $subject = Subject::where('id',$id)->where('is_accepted',true)->first();
        if($subject === null)
            return redirect()->route('subjects')->with('subject_not_found_watch', true);

        $data = $request->all();

        $page = null;
        if($request->has('page'))
            $page = $data['page'];

        $user = Auth::user();
        $teachers = $subject->teachers()->get();
        $votes = [];
        foreach($teachers as $teacher){
            if(!$teacher->pivot->is_active)
                continue;

            $points = 0;
            $teacher_votes = $teacher->voters()->get();
            $has_positive_vote = false;
            $has_negative_vote = false;
            foreach($teacher_votes as $t_vote){
                if($t_vote->pivot->is_positive_vote === null){
                    continue;
                }
                else if($t_vote->pivot->is_positive_vote){
                    $points += 1;
                    if($user !== null){
                        if($t_vote->pivot->user_id == $user->id){
                            $has_positive_vote = true;
                        }
                    }
                }
                else{
                    $points -= 1;
                    if($user !== null){
                        if($t_vote->pivot->user_id == $user->id){
                            $has_negative_vote = true;
                        }
                    }
                }
            }
            $votes[$teacher->id] = [
                'points' => $points,
                'hasPosVote' => $has_positive_vote,
                'hasNegVote' => $has_negative_vote
            ];
        }
        
        if($user === null)
            return view('subject', compact('subject','teachers', 'votes', 'page'));

        return view('subject', compact('subject','teachers','user','votes', 'page'));
    }

    public function givenSubjects() {
        $user = Auth::user();

        $subjects = null;

        switch ($user->spec) {
            case 'A':
                $subjects = Subject::all()->where('existsOnA',true)->toArray();
                break;
            case 'B':
                $subjects = Subject::all()->where('existsOnB',true)->toArray();
                break;
            case 'C':
                $subjects = Subject::all()->where('existsOnC',true)->toArray();
                break;
            case 'NOTHING':
                $subjects = Subject::all()->toArray();
                break;
            default:
                break;
        }
        $user_subjects = $user->subjects()->get();
        if($user_subjects === null)
            return view('given_subjects',compact('subjects'));
        
        foreach($user_subjects as $subject){
            for($i = 0; $i < count($subjects);$i++){
                if($subject->code === $subjects[$i]["code"]){
                    array_splice($subjects,$i,1);
                    break;
                }
            }
        }
        return view('given_subjects', compact('subjects','user_subjects'));
    }

    public function showFind() {
        $user = Auth::User();
        $can_calculate = $user->hasSpecialization();
        $optional_subjects = $user->getAvailableOptionalSubjects();
        $calculation_history = $user->calculations()->get();
        $subjects = Subject::where('is_accepted',true)->get();
        $sub_data = [];
        foreach($subjects as $subject){
            $sub_data[$subject->code] = [
                'url' => $subject->url,
                'name' => $subject->name];
        }
        return view('find',compact('can_calculate','optional_subjects', 'calculation_history', 'sub_data'));
    }

    public function addNewGrade(AddGradeFormRequest $request){
        $data = $request->all();
        $subject = Subject::where('id',$data['subject'])->first();
        $user = Auth::User();

        $last_grade = $user->getGrade($subject->code);
        if($last_grade === null){
            $user->setGrade($subject->code, (int)$data['grade']);
            return redirect()->route('newsubject')->with('grade_added', true);
        }
        else{
            return redirect()->route('newsubject')->with('grade_added', false);
        }
    }

    public function editGivenGrade($id){
        $subject_to_update = Subject::find($id);
        if ($subject_to_update === null) {
            return redirect()->route('newsubject')->with('subject_not_exists',true);
        }
        $user = Auth::User();
        $grade = $user->getGrade($subject_to_update->code);
        $user_subjects = $user->subjects()->get();
        if($user_subjects === null)
            return view('given_subjects',compact('subjects'));

        return view('edit_given_subject', compact('user_subjects','subject_to_update', 'grade'));
    }

    public function updateGivenGrade(ModifyGradeFormRequest $request, $id){
        $data = $request->all();
        $subject_to_update = Subject::find($id);
        if ($subject_to_update === null) {
            return redirect()->route('newsubject')->with('subject_not_exists',true);
        }
        $user = Auth::User();
        $user->setGrade($subject_to_update->code,$data['grade']);
        return redirect()->route('newsubject')->with('grade_updated', true);
    }

    public function deleteGrade($id){
        $subject_to_delete = Subject::find($id);
        if ($subject_to_delete === null) {
            return redirect()->route('newsubject')->with('subject_not_exists',true);
        }
        $user = Auth::User();
        $result = $user->deleteGrade($subject_to_delete);
        if ($result === null) {
            return redirect()->route('newsubject')->with('grade_deleted',false);
        }
        return redirect()->route('newsubject')->with('grade_deleted',true);
    }
}
