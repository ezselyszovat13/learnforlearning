<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function comments($id){
        $teacher = Teacher::where('id',$id)->first();
        $comments = $teacher->comments();
        $was_comment = false;
        foreach ($comments as $author => $data) {
            if($data['comment'] !== null){
                $was_comment = true;
                break;
            }
        }
        return view('comments',compact('comments', 'teacher', 'was_comment'));
    }
}
