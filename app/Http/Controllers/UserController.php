<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createRegister()
    {
        return view('pages.register');
    }

    public function storeRegister(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'email' => 'required|unique:users,email',
                'username' => 'required|min:5|max:30|unique:users,name',
                'telephone' => 'required|numeric',
                'address' => 'required|min:5|max:30',
                'role' => 'required',
                'password' => 'required|min:5|max:30',
                'confirm_password' => 'required|same:password',
            ]
        );

        User::create([
            'email' => $request->email,
            'name' => $request->username,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back();
    }

    public function login()
    {
        return view('pages.login');
    }

    public function prosesLogin(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required|min:5|max:30',
            ]
        );

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credential)){
            return redirect('/dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
