<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;


class ProductController extends Controller
{
    

	public function index(){

	}

	public function shop(){

		$products = Product::all();
		return view('shop.index',compact('products'));
	}


	public function addCart(Request $request, $id){

		$product = Product::find($id);
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);

		$request->session()->put('cart',$cart);
		//dd($request->session()->get('cart'));
		return redirect()->route('shop.index');
	}

	public function getCart(){
		if(!Session::has('cart')){
			return view('shop.cartPage');
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		//return 'wee';
		return view('shop.cartPage', ['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);

	}

	public function cartAddByOne(Request $request, $id){
		$product = Product::find($id);
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);

		$request->session()->put('cart',$cart);

		return redirect()->route('product.cartPage');
	}

	public function cartReduceByOne($id){
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->reduceByOne($id);

		Session::put('cart',$cart);

		return redirect()->route('product.cartPage');
	}

	public function cartRemove($id){
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);

		Session::put('cart',$cart);

		return redirect()->route('product.cartPage');
	}

	

	public function updateCart(Request $request){
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);
	}


	



}
