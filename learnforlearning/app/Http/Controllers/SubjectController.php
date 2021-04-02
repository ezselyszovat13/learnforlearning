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
        $subjects = Subject::all();
        return view('subjects', compact('subjects'));
    }

    public function showSubject($id) {
        $subject = Subject::where('id',$id)->first();
        if($subject === null)
            return view('subjects');

        $user = Auth::user();
        $teachers = $subject->teachers()->get();
        $votes = [];
        foreach($teachers as $teacher){
            $points = 0;
            $teacherVotes = $teacher->voters()->get();
            $hasPositiveVote = false;
            $hasNegativeVote = false;
            foreach($teacherVotes as $tVote){
                if($tVote->pivot->is_positive_vote === null){
                    continue;
                }
                else if($tVote->pivot->is_positive_vote){
                    $points += 1;
                    if($user !== null){
                        if($tVote->pivot->user_id == $user->id){
                            $hasPositiveVote = true;
                        }
                    }
                }
                else{
                    $points -= 1;
                    if($user !== null){
                        if($tVote->pivot->user_id == $user->id){
                            $hasNegativeVote = true;
                        }
                    }
                }
            }
            $votes[$teacher->id] = [
                'points' => $points,
                'hasPosVote' => $hasPositiveVote,
                'hasNegVote' => $hasNegativeVote
            ];
        }
        
        if($user === null)
            return view('subject', compact('subject','teachers', 'votes'));

        return view('subject', compact('subject','teachers','user','votes'));
    }

    public function givenSubjects() {
        $user = Auth::user();

        $subjects = null;

        switch ($user->spec) {
            case 'A':
                $subjects = Subject::all()->where('existsOnA',true);
                break;
            case 'B':
                $subjects = Subject::all()->where('existsOnB',true);
                break;
            case 'C':
                $subjects = Subject::all()->where('existsOnC',true);
                break;
            case 'NOTHING':
                $subjects = Subject::all();
                break;
            default:
                break;
        }
        $userSubjects = $user->subjects()->get();
        if($userSubjects === null)
            return view('givenSubjects',compact('subjects'));
        else
        return view('givenSubjects', compact('subjects','userSubjects'));
    }

    public function showFind() {
        $user = Auth::User();
        $canCalculate = $user->hasSpecialization();
        $optionalSubjects = $user->getAvailableOptionalSubjects();
        $calculationHistory = $user->calculations()->get();
        $subjects = Subject::all();
        $subData = [];
        foreach($subjects as $subject){
            $subData[$subject->code] = [
                'url' => $subject->url,
                'name' => $subject->name];
        }
        return view('find',compact('canCalculate','optionalSubjects', 'calculationHistory', 'subData'));
    }

    public function addNewGrade(AddGradeFormRequest $request){
        $data = $request->all();
        $subject = Subject::where('id',$data['subject'])->first();
        $user = Auth::User();

        $lastGrade = $user->getGrade($subject->code);
        if($lastGrade === null){
            $user->setGrade($subject->code, (int)$data['grade']);
            return redirect()->route('newsubject')->with('grade_added', true);
        }
        else{
            return redirect()->route('newsubject')->with('grade_added', false);
        }
    }

    public function editGivenGrade($id){
        $subjectToUpdate = Subject::find($id);
        if ($subjectToUpdate === null) {
            return redirect()->route('newsubject')->with('subject_not_exists',true);
        }
        $user = Auth::User();
        $grade = $user->getGrade($subjectToUpdate->code);
        $userSubjects = $user->subjects()->get();
        if($userSubjects === null)
            return view('givenSubjects',compact('subjects'));

        return view('edit-given-subject', compact('userSubjects','subjectToUpdate', 'grade'));
    }

    public function updateGivenGrade(ModifyGradeFormRequest $request, $id){
        $data = $request->all();
        $subjectToUpdate = Subject::find($id);
        if ($subjectToUpdate === null) {
            return redirect()->route('newsubject')->with('subject_not_exists',true);
        }
        $user = Auth::User();
        $user->setGrade($subjectToUpdate->code,$data['grade']);
        return redirect()->route('newsubject')->with('grade_updated', true);
    }

}
