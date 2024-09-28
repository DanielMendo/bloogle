<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('home');
    }
}
