<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;

class MainController extends Controller
{
    public function index() {
        $users = User::count();
        
        $data = 0;

        User::all()->each(function ($user) use (&$data) {
            $data = $data + $user->subjects()->count();
        });

        return view('main', compact('users','data'));
    }
}
