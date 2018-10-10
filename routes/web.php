<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[
	'uses'=>'ProductController@shop',
	'as'=>'shop.index'
]);

//Cart

Route::get('/your-cart', [
	'uses'=>'ProductController@getCart',
	'as'=>'product.cartPage'
]);

Route::get('/addCart/{id}', [
	'uses'=>'ProductController@addCart',
	'as'=>'product.addCart'
]);

Route::get('/add/{id}',[
	'uses'=>'ProductController@cartAddByOne',
	'as'=>'product.addByOne'
]);

Route::get('/reduce/{id}',[
	'uses'=>'ProductController@cartReduceByOne',
	'as'=>'product.reduceByOne'
]);

Route::get('/remove/{id}',[
	'uses'=>'ProductController@cartRemove',
	'as'=>'product.removeCart'
]);

Route::get('/update-cart',[
	'uses'=>'ProductController@updateCart',
	'as'=>'product.updateCart'
]);

//Stripe

Route::get('checkout', [
	'uses'=>'CreditCardController@checkout',
	'as'=>'cc.checkout'
]);

Route::post('checkout', [
	'uses'=>'CreditCardController@postCheckout',
	'as'=>'cc.checkout'
]);


//Paypal

Route::post('payment', [
	'uses' => 'PaymentController@postPayment',
    'as' => 'payment'
    
]);

Route::get('payment/success', [
	'uses' => 'PaymentController@paymentStatus',
    'as' => 'payment.success'  
]);


//User

Route::group(['prefix'=>'user'], function(){

	Route::group(['middleware'=>'guest'], function(){

		Route::get('/signup',[
			'uses'=>'ProfileController@signup',
			'as'=>'user.signup'
		]);

		Route::post('/signup',[
			'uses'=>'ProfileController@postSignup',
			'as'=>'user.signup'
		]);

		Route::get('/signin',[
			'uses'=>'ProfileController@signin',
			'as'=>'user.signin'
		]);

		Route::post('/signin',[
			'uses'=>'ProfileController@postSignin',
			'as'=>'user.signin'
		]);

	});


	Route::group(['middleware'=>'auth'], function(){

		Route::get('/profile',[
			'uses'=>'ProfileController@index',
			'as'=>'user.profile'
		]);

		Route::get('/logout',[
			'uses'=>'ProfileController@logout',
			'as'=>'user.logout'
		]);

	});


});