<?php

namespace App;

class Cart
{
	public $items = [];
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($cart)
	{
		if($cart){
			$this->items = $cart->items;
			$this->totalQty = $cart->totalQty;
			$this->totalPrice = $cart->totalPrice;
		}
	}

	public function add($item, $id)
	{
		$storedItem = [
			'item_id' => $id,
			'qty' => '0',
			'price' => $item->price,
			'item' => $item
		];

		$key = array_search($id, array_column($this->items, 'item_id'));

		if($this->items && ($this->items[$key]['item_id'] == $storedItem['item_id'])){
			$this->items[$key]['qty']++;
			$this->items[$key]['price'] = $item->price * $this->items[$key]['qty'];
		}else{
			$storedItem['qty']++;
			array_push($this->items, $storedItem);
		}

		$this->totalQty++;
		$this->totalPrice += $item->price;

	}

	public function reduceByOne($id)
	{
		$key = array_search($id, array_column($this->items, 'item_id'));

		$this->items[$key]['qty']--;
		$this->items[$key]['price'] -= $this->items[$key]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$key]['item']['price'];

		if($this->items[$key]['qty'] <= 0){
			array_splice($this->items, $key, 1);
		}

	}

	public function removeItem($id)
	{
		$key = array_search($id, array_column($this->items, 'item_id'));

		$this->totalQty -= $this->items[$key]['qty'];
		$this->totalPrice -= $this->items[$key]['price'];
		array_splice($this->items, $key, 1);
	}

	public function updateItem($qty, $id){

		$storedItem = [
			'item_id' => $id,
			'qty'=>'0',
			'price'=>$item->price,
			'item'=>$item
		];

		$key = array_search($id, array_column($this->items, 'item_id'));

		if($this->items && ($this->items[$key]['item_id'] == $storedItem['item_id'])){

			$this->items[$key]['qty'] = $qty;
			$this->items[$key]['price'] = $item->price * $qty;
		}

		$this->totalQty+= $qty;
		$this->totalPrice += $item->price;

	}


}
