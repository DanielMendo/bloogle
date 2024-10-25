<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentSuccessController extends Controller
{

    public function __invoke()
    {
        $user = Auth::user();
        $user->verified = true;
        $user->save();

        Session::flash('success', '¡Ya estás verificado!');

        return redirect()->route('profile.show', $user->slug);
    }
}

