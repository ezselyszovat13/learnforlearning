<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Http\Requests\AddGradeFormRequest;
use App\Http\Requests\ModifyGradeFormRequest;
use Auth;

class SubjectController extends Controller
{
    public function showAll() {
        $subjects = Subject::all();

        return view('subjects', compact('subjects'));
    }

    public function givenSubjects() {
        $subjects = Subject::all();
        
        $user = Auth::user();
        $userSubjects = $user->subjects()->get();

        if($userSubjects === null)
            return view('givenSubjects',compact('subjects'));
        else
        return view('givenSubjects', compact('subjects','userSubjects'));
    }

    public function showFind() {
        return view('find');
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
        var_dump("HI!");
        $data = $request->all();

        $subject = Subject::find($id);
        $user = Auth::User();
        $user->setGrade($subject->code, (int)$data['grade']);
        return redirect()->route('newsubject')->with('grade_updated', true);
    }


}
