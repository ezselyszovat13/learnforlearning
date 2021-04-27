<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function comments($id, Request $request){
        $data = $request->all();

        $page = null;
        if($request->has('page'))
            $page = $data['page'];

        $sub_page = null;
        if($request->has('subpage'))
            $sub_page = $data['subpage'];
        
        $subject_id = null;
        if($request->has('subjectId'))
            $subject_id = $data['subjectId'];

        $teacher = Teacher::where('id',$id)->first();
        $comments = $teacher->comments();
        $was_comment = false;
        foreach ($comments as $author => $data) {
            if($data['comment'] !== null){
                $was_comment = true;
                break;
            }
        }
        return view('comments',compact('comments', 'teacher', 'was_comment', 'page', 'sub_page', 'subject_id'));
    }
}
