<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserSignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function register()
    {
        return view('website.auth.register');
    }

    public function signUp(UserSignupRequest $request)
    {
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Alert::success('Success Message', 'success', 'Account Created Successfully!');
        return to_route('login');
    }

    public function login()
    {
        return view('website.auth.login');
    }

    public function signIn(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials, true)) {
            Alert::success('Success Message', 'Login Successfully!');
            return to_route('index');

        } else {
            Alert::success('Success Message', 'Invalid Credentials!');
            return to_route('login');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        Alert::warning('Warning Message', 'success', 'You are Logged out!');
        return to_route('login');
    }

    public function profile()
    {
        $user = Auth::guard('user')->user();
        return view('website.users.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $authUserId = Auth::guard('user')->user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $authUserId,
            'address' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($authUserId);
        $data = $request->except('password', '_token');
        // Only hash and update the password if it is provided

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        Alert::info('Info Message', 'Account Updated Successfully!');
        return back();
    }
}
