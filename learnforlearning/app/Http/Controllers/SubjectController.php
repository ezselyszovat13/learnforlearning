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
        $subjects = Subject::all()->where('user_id',Auth::id());

        if($subjects === null)
            return view('givenSubjects');
        else
        return view('givenSubjects', compact('subjects'));
    }

    public function showFind() {
        return view('find');
    }


}
