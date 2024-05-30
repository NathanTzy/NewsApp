<?php

namespace App\Http\Controllers\profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function Index()
    {
        $title = 'My Profile';
        return view('home.profile.index', compact('title'));
    }

        public function changePassword()
        {
            $title = 'Change Password';
            return view('home.profile.changePassword', compact('title'));
        }

    public function updatePassword(Request $request)
    {
        // validate
        $this->validate($request, [
            'currentPassword' => 'required',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6'
        ]);

        // check current password status
        $currentPasswordStatus = Hash::check($request->currentPassword, auth()->user()->password);

        if ($currentPasswordStatus) {

            if ($request->password == $request->confirmPassword) {
                // get user login by id
                $user = auth()->user();

                //update new password
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', 'password has been updated');
            } else {
                return redirect()->back()->with('errors', 'password doesnt match!');
            }
        } else {
            return redirect()->back()->with('errors', 'Current password is incorrect!');
        }
    }

    public function allUser()
    {
        $title = 'All user';

        $user = User::where('role', 'user')->get();

        return view('home.user.index', compact('title', 'user'));
    }

    public function resetPassword($id)
    {
        // get user by id
        $user = User::find($id);
        $user->password = Hash::make('123456');
        $user->save();

        return back()->with('success', 'Reset Password Successfully!');
        return back()->with('error', 'Reset Password failed!');
    }

    public function createProfile()
    {
        $title = 'Create Profile';

        return view('home.profile.create', compact('title'));
    }

    public function storeProfile(request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg|max:2848'
        ]);

        // store image
        $image = $request->file('image');
        $image->storeAs('public/profile', $image->getClientOriginalName());

        // get user login
        $user = auth()->user();

        // create data profile
        $user->profile()->create([
            'first_name' => $request->first_name,
            'image' => $image->getClientOriginalName()
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile created');
    }

    public function editProfile()
    {
        // get data user login

        $title = 'Edit Profile';
        $user = auth()->user();

        return view('home.profile.edit', compact('user', 'title'));
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // get usr login
        $user = auth()->user();

        // cek kondisi image klo ga di upload
        if ($request->file('image') == '') {
            $user->profile->update([
                'first_name' => $request->first_name
            ]);
        }else{
            // delete image
            Storage::delete('public/profile'.basename($user->profile->image));

            //  upload gambar baru 
            $image = $request->file('image');
            $image->storeAs('public/profile',$image->getClientOriginalName());

            // update image
            $user->profile->update([
                'first_name' => $request->first_name,
                'image'      => $image->getClientOriginalName()
            ]);

            return redirect(route('profile.index'))->with('Success','Profile updated');
        }
        return redirect(route('profile.index'))->with('Success','Profile updated');
    }
}
