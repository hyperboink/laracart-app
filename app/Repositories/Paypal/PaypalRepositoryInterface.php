<?php

namespace App\Repositories\Paypal;

interface PaypalRepositoryInterface
{
	public function pay($data);

	public function status();
}