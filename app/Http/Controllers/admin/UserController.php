<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function store(UserSignupRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return back()->with('success', 'User Created Successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($id);
        $data = $request->except('password', '_token');
        // Only hash and update the password if it is provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return back()->with('success', 'User Updated Successfully!');
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'User Deleted Successfully!');
    }
}
