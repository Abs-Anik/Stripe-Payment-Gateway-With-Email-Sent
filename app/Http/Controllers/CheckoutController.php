<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Session;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function stripe()
    {
        return view('checkout.check');
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested from LearnWithAnik"
        ]);
        // $username = Auth::user()->username;
        $mytime = date("Y-m-d");
        $mailData = [
            'sl' => '1',
            'name' => 'Anik',
            'email' => $request->email,
            'price' => $request->amount,
            'date' => $mytime
        ];

        \Mail::to($request->email)->send(new \App\Mail\EmailDemo($mailData));
        $notification = array(
            'Message' => 'Payment Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->route('stripe.index')->with($notification);
    }
    
}