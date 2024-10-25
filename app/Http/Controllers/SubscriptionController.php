<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('susbscriptions.index');
    }

    public function show($subscriptionId)
    {
        $subscription = Auth::user()->subscriptions->find($subscriptionId);

        return view('susbscriptions.show', compact('subscription'));
    }

    public function cancel($subscriptionId)
    {
        $subscription = Auth::user()->subscriptions->where('id', $subscriptionId)->firstOrFail();

        $user = Auth::user();
        $user->verified = false;
        $user->save();
        
        $subscription->cancel();

        return redirect()->route('subscription.index')->with('success', 'La suscripción ha sido cancelada exitosamente.');
    }


}
