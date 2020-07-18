<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Paypal\PaypalRepository;

class PaymentController extends Controller
{
	private $paypalRepo;

	public function __construct(PaypalRepository $paypalRepository)
	{
		$this->paypalRepo = $paypalRepository;
	}

	public function postPayment(Request $request)
	{
		return $this->paypalRepo->pay($request->all());
	}

	public function paymentStatus()
	{
		return $this->paypalRepo->status();
	}

}
