<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripe()
    {
        $valueToPay = 10525;
        return view('stripe', compact('valueToPay'));
    }

    public function stripePost(Request $request)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->totalToPay,
                "currency" => "Mzn",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();

    }
}
