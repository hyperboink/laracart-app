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
		if(!Session::has('cart')){
			return view('shop.cartPage');
		}

		$cart = $this->cartRepo->get();

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
		/*$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->updateItem($product, $product->id);*/
	}




}
