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

	/**
	 * Return items in the cart
	 * @return array Cart
	 */
	public function get()
	{
		return $this->cart();
	}

	/**
	 * Add item in the cart
	 * @param Request $request
	 * @param int $id
	 */
	public function add($request, $id)
	{
		$product = $this->products->find($id);

		$cart = $this->cart();
		
		$cart->add($product, $product->id);

		$request->session()->put('cart', $cart);
	}

	/**
	 * Reduce single item in the cart
	 * @param int $id
	 */
	public function reduceByOne($id)
	{
		$cart = $this->cart();

		$cart->reduceByOne($id);

		Session::put('cart', $cart);
	}

	/**
	 * Remove specific item in the cart
	 * @param  int $id
	 */
	public function remove($id)
	{
		$cart = $this->cart();

		$cart->removeItem($id);

		Session::put('cart', $cart);
	}

	/**
	 * Update item in the cart
	 * @param  int $qty
	 * @param  int $id
	 */
	public function updateItem($qty, $id)
	{
		$cart = $this->cart();
		$cart->updateItem($product, $product->id);
	}

	/**
	 * Return cart items
	 * @return array Cart 
	 */
	private function cart(){
		return new Cart(Session::has('cart') ? Session::get('cart') : null);
	}


}