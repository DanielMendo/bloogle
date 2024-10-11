<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    public function index() 
    {
        return view('account.settings');
    }

    public function updateEmail(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|max:60|unique:users,email,' . $user->id, 
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        return back()->with('email_success', 'Correo actualizado con éxito.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }
    
        $user->update([
            'password' => Hash::make($request->new_password), 
        ]);
    
        return back()->with('password_success', 'Contraseña actualizada con éxito.');
    }

    public function deleteAccount(Request $request, User $user)
    {
        $request->validate([
            'password_confirmation' => 'required',
        ]);

        if (!Hash::check($request->password_confirmation, $user->password)) {
            return back()->withErrors(['password_confirmation' => 'La contraseña es incorrecta.']);
        }

        $user->delete();

        return redirect()->route('login');
    }
}
