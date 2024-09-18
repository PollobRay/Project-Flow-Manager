<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if(Auth::check())
        {
            Auth::logout();
        } 

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',  //Here variable name is as same as database table column
        ]);

        $data['password'] = Hash::make($data['password']); // created hash password

        $user = User::create($data);

        if($user)
        {
            return redirect()->route('login');
        }
    }

    public function login(Request $request)
    {
        if(Auth::check())
        {
            Auth::logout();
        } 

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required', 
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('profile');
        } else {
            // Authentication failed
            //dd('Login failed, credentials:', $credentials); // Debug to check what’s wrong
            //return redirect()->route('login')->withErrors(['message' => 'Login failed']);
            return redirect()->route('login')->withErrors(['message' => 'Login failed']);
        }

    }

    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();

            return redirect()->route('login');
        }
        return redirect()->route('home');
    }

    public function profile()
    {
        if(Auth::check())
        {
            return view('profile');
        } 
        else
        {
            return redirect()->route('login');
        }
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed',  // Confirm the password with password_confirmation
        ]);

        $data['password'] = Hash::make($data['password']);

        $user->update($data);
        
        Auth::logout();
        return redirect()->route('login')->with('success', 'Information Updated successfully');
        
    }
}
