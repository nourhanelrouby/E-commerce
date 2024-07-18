<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\b;

class AdminController extends Controller
{
    // Login
    public function login()
    {
        return view('admin.login');
    }

    public function loginPost(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->two ? true : false;

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return to_route('admin.dashboard')->with('success', 'login successfully');
        } else {
            return back()->with('error', 'E-mail or password is not correct');
        }

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . Auth::guard('admin')->id(),
        ]);
        $admin = Admin::find(Auth::guard('admin')->id());
        $data = $request->except('password', '_token');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);
        return back()->with('success', 'Profile updated successfully!');
    }
}
