<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Requests\ModifySpecFormRequest;

class UserController extends Controller
{
    public function show() {
        $user = Auth::user();
        return view('personal',compact('user'));
    }

    public function editSpecialization(){
        $user = Auth::User();
        $oldSpec = $user['spec'];
        return view('edit-specialization', compact('user','oldSpec'));
    }

    public function updateSpecialization(ModifySpecFormRequest $request, $id){
        var_dump("HEY");
        $data = $request->all();
        $user = Auth::User();
        $user->update($data);
        return redirect()->route('personal')->with('spec_updated', true);
    }
}
