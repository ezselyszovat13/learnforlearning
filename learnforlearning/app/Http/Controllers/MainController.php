<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    public function index() {
        $users = User::count();
        return view('main', compact('users'));
    }
}
