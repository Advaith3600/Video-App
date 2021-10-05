<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Stripe;
use Session;
use Exception;

class SubscriptionController extends Controller
{
    public function stripe($id = 1)
    {
        return view('subscription.create')->with('id', $id);
    }

    public function stripePost(Request $request)
    {
        // $request->plan
        // $prodcut = Product::find($requst->product_id);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "INR",
            "source" => $request->stripeToken,
            "description" => "This payment is testing purpose of websolutionstuff.com",
        ]);

        Session::flash('success', 'Payment Successful !');

        return back();
    }
}
