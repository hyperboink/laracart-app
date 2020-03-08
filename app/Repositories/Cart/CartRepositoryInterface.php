<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
	public function add($request, $id);

	public function reduceByOne($id);

	public function remove($id);

	public function updateItem($qty, $id);
}