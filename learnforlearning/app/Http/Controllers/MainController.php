<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use Auth;

class MainController extends Controller
{
    public function index() {
        $users = User::count();

        $data = 0;
        $comments = [];
        $commentCount = 0;

        User::all()->each(function ($user) use (&$data, &$comments, &$commentCount) {
            $data = $data + $user->subjects()->count();
            $userComment = $user->votes()->get()->first();
            if($userComment !== null){
                $teacher = Teacher::where('id',$userComment->pivot->teacher_id)->first();
                $comment = [
                    'author' => $user->name,
                    'teacher' => $teacher->name,
                    'comment' => $userComment->pivot->comment
                ];
                if($commentCount < 5) array_push($comments,$comment);
                $commentCount += 1;
            }
        });

        $bestTeacher = Teacher::all()->first()->name;
        $maxPoints = 0;

        Teacher::all()->each(function ($teacher) use (&$bestTeacher, &$maxPoints) {
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
}
