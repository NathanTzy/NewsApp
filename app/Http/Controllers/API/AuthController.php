<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // cek credentials (login)
            $credentials = request(['email', 'password']);
            if (!Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ])) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            };

            // cek klo password g sesuai
            $user = User::where('email', $credentials['email'])->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            };

            // jika berasil cek password maka loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'bearer',
                'user' => $user
            ], 'Authenticated', 200);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function register(Request $request)
    {
        try {
            // validate
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);

            // check kondisi password dan confirm password
            if ($request->password != $request->confirm_password) {
                return ResponseFormatter::error([
                    'message' => 'Password not match'
                ], 'Authentication Failed', 401);
            }

            // create akun
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // get data akun
            $user = User::where('email', $request->email)->first();

            // create token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            // response
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated', 200);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    // logout
    public function logout(Request $request)
    {
        $token =  $request->user()->currentAccessToken()->delete;
        return ResponseFormatter::success($token, 'Token Rekvoked');
    }

    // update password
    public function updatePassword(Request $request)
    {
        try {
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'required|string|min:6|',
                'confirm_password' => 'required|string|min:6|'
            ]);
            //get data user
            $user = Auth::user();
            //cek passwor lama
            if (!Hash::check($request->old_password, $user->password)) {
                return ResponseFormatter::error([
                    'message' => 'Password salah'
                ], 'AUTHENTICATION FAILED', 401);
            }
            //cek password baru dan konfirmasi password baru
            if ($request->new_password != $request->confirm_password) {
                return ResponseFormatter::error([
                    'message' => 'password not match'
                ], 'Authentication Failed', 401);
            }
            //update password
            $user->password = Hash::make($request->new_password);
            $user->save();
            return ResponseFormatter::success(['message' => 'Passwor berhasil dirubah'], 'Password changed successfully', 200);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
    public function allUsers()
    {
        $users = User::where('role', 'user')->get();

        return ResponseFormatter::success(
            $users,
            'Data user berhasil dimabil'
        );
    }
    // store profile
    public function storeProfile(Request $request)
    {
        try {
            // store data
            $this->validate($request, [
                'first_name' => 'required|string|max:200',
                'image' => 'image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // get user login
            $user = auth()->user();

            // upload image
            $image = $request->file('image');
            $image->storeAs('public/profile', $image->hashName());

            // create profile
            $user->profile()->create([
                'first_name' => $request->first_name,
                'image' => $image->hashName()
            ]);

            // get data profile
            $profile = $user->profile;

            // return response
            return ResponseFormatter::success(
                $profile,
                'profile updated'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    // update profile
    public function updateProfile(Request $request)
    {
        try {
            $this->validate($request, [
                'first_name' => 'required',
                'image' => 'image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // get usr login
            $user = auth()->user();

            // klo gada profile
            if (!$user->profile) {
                // tampilkan error jika user tidak punya profil
                return ResponseFormatter::error(['message'=>'no profile found'], 'Auth failed', 404);
            }
            // cek kondisi image klo ga di upload
            if ($request->file('image') == '') {
                $user->profile->update([
                    'first_name' => $request->first_name
                ]);
            } else {
                // delete image
                Storage::delete('public/profile' . basename($user->profile->image));

                //  upload gambar baru 
                $image = $request->file('image');
                $image->storeAs('public/profile', $image->getClientOriginalName());

                // update image
                $user->profile->update([
                    'first_name' => $request->first_name,
                    'image'      => $image->getClientOriginalName()
                ]);
            }
            return ResponseFormatter::success($user, 'Success');
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
}
