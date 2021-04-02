<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function comments($id){
        $teacher = Teacher::where('id',$id)->first();
        $comments = $teacher->comments();
        $wasComment = false;
        foreach ($comments as $author => $data) {
            if($data['comment'] !== null){
                $wasComment = true;
                break;
            }
        }
        return view('comments',compact('comments', 'teacher', 'wasComment'));
    }
}
