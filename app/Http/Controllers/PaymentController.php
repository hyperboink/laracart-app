<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use URL;
use Session;
use Redirect;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{
    private $_api_context;
    public function __construct()
    {

        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    

    public function postPayment(Request $request){


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');


        $item = array();
        $items = array();
        foreach($request->product as $key=>$product){
            $item[$key] = new Item();
            $item[$key]->setName($product) 
                ->setCurrency('USD')
                ->setQuantity($request->qty[$key])
                ->setPrice($request->price[$key]);
            
            $items[] = $item[$key];
        }
        


        $item_list = new ItemList();
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->totalPrice);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.success'))
            ->setCancelUrl(URL::route('payment.success'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try{
            $payment->create($this->_api_context);
        }catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {

            return Redirect::away($redirect_url);
        }
        return Redirect::route('shop.index')
            ->with('error', 'Unknown error occurred');
    }







    public function paymentStatus() {

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect::route('shop.index')
                ->with('error', 'Payment failed');
        }
        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        

        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') { 
            return Redirect::route('shop.index')
                ->with('success', 'You have successfully purchased the item!');
                
        }
        return Redirect::route('shop.index')
            ->with('error', 'Payment failed');
    }


    

}
