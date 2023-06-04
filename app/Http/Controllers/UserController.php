<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginView()
    {
        return view('admin.user.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if(!$user)
        {
            return redirect()->route('loginView')->with('error', 'Username not found');
        }

        if($user->password !== $request->password)
        {
            return redirect()->route('loginView')->with('error', 'Password is wrong');
        }

        Session::put('admin', $user);
        return redirect()->route('admin.home');
    }
}
