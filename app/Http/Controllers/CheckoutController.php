<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan )
    {
        return $request->user()
            ->newSubscription('premium', $plan)
            ->checkout([
                'success_url' => route('checkout.verified'),
                'cancel_url' => route('home'),
        ]);
    }
}
