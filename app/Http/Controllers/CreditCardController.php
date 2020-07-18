<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Cart;
use Stripe\Charge;
use Stripe\Stripe;


class CreditCardController extends Controller
{
    public function checkout()
    {
		if(!Session::has('cart')){
			return redirect()->route('shop.index');
		}

		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		$totalPrice = $cart->totalPrice;

		return view('shop.ccCheckout', ['totalPrice'=>$totalPrice]);
	}

	public function postCheckout(Request $request)
	{
		if(!Session::has('cart')){
			return redirect()->route('shop.index');
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);

		\Stripe\Stripe::setApiKey("sk_test_YQiXp37W13kEJYZOZRKLQaX8");

		try{
			\Stripe\Charge::create(array(
			  "amount" => $cart->totalPrice * 100,
			  "currency" => "usd",
			  "source" => $request->stripeToken,
			  "description" => "Laracart Test Charge"
			));
		}catch(\Exception $e){
			return redirect()->route('cc.checkout')->with('error', $e->getMessage());
		}

		Session::forget('cart');

		return redirect()->route('shop.index')->with('success','You have successfully purchased the item!');
	}
}
