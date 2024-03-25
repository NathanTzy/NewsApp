<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function Index(){
        $title = 'My Profile';
        return view('home.profile.index', compact('title')); 
    }

    public function changePassword(){
        $title = 'Change Password';
        return view('home.profile.changePassword', compact('title'));
    }

    public function updatePassword(Request $request){
        // validate
        $request->validate($request, [
            'currentPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required'
        ]);

        // check current password status
        $currentPasswordStatus = Hash::check($request->currentPassword, auth()->user()->password);
    }
}
