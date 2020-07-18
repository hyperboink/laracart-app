<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Cart\CartRepository;
use App\Product;
use App\Cart;
use Session;

class ProductController extends Controller
{
	public $cartRepo;

	public function __construct(CartRepository $cartRepository)
	{
		$this->cartRepo = $cartRepository;
	}

	public function shop()
	{
		$products = Product::all();

		return view('shop.index',compact('products'));
	}


	public function addCart(Request $request, $id)
	{
		$this->cartRepo->add($request, $id);

		return redirect()->route('shop.index');
	}

	public function getCart()
	{
		$cart = $this->cartRepo->get();

		if(!Session::has('cart') || count($cart->items) <= 0){
			return redirect()->route('shop.index');
		}

		return view('shop.cartPage', [
			'products' => $cart->items,
			'totalPrice' => $cart->totalPrice
		]);

	}

	public function cartAddByOne(Request $request, $id)
	{
		$this->cartRepo->add($request, $id);

		return redirect()->route('product.cartPage');
	}

	public function cartReduceByOne($id)
	{
		$this->cartRepo->reduceByOne($id);

		return redirect()->route('product.cartPage');
	}

	public function cartRemove($id)
	{
		$this->cartRepo->remove($id);

		return redirect()->route('product.cartPage');
	}

	public function updateCart(Request $request)
	{
		$this->cartRepo->updateItem($product, $product->id);

		return redirect()->route('product.cartPage');
	}


	public function apiCart()
	{
		if(!Session::has('cart')){
			return view('shop.cartPage');
		}

		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);

		return response()->json($cart);
	}



}
