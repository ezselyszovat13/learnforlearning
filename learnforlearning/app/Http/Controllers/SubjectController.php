<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
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


}
