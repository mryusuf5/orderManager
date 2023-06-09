<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Site_settings;

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
        return redirect()->route('admin.orders.index');
    }

    public function logout()
    {
        Session::pull('admin');

        return redirect()->route('loginView');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settingsPost(Request $request)
    {
        $settings = Site_settings::where('id', 1)->first();
        $settings->free_sauces = $request->free_sauces;
        $settings->style = $request->style;
        $settings->save();

        return redirect()->route('admin.settings')->with('success', 'Instellingen opgeslagen');
    }
}
