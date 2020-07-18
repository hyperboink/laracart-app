<?php

namespace App\Repositories\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use Session;
use App\Product;
use App\Cart;


class CartRepository implements CartRepositoryInterface
{
	private $products;

	public function __construct(Product $products)
	{
		$this->products = $products;
	}

	public function get()
	{
		return $this->cart();
	}

	public function add($request, $id)
	{
		$product = $this->products->find($id);

		$cart = $this->cart();
		
		$cart->add($product, $product->id);

		$request->session()->put('cart', $cart);
	}

	public function reduceByOne($id)
	{
		$cart = $this->cart();

		$cart->reduceByOne($id);

		Session::put('cart', $cart);
	}

	public function remove($id)
	{
		$cart = $this->cart();

		$cart->removeItem($id);

		Session::put('cart', $cart);
	}

	public function updateItem($qty, $id)
	{
		$cart = $this->cart();
		$cart->updateItem($product, $product->id);
	}

	private function cart(){
		return new Cart(Session::has('cart') ? Session::get('cart') : null);
	}


}