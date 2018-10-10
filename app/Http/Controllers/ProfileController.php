<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

use App\Http\Requests;

class ProfileController extends Controller
{
    
	public function index(){
		return view('user.profile');
	}

	public function signin(){
		return view('user.signin');
	}

	public function postSignin(Request $request){

		$this->validate($request,[
			'email'=>'email|required',
			'password'=>'|required|min:3'
		]);

		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
			return redirect()->route('user.profile');
		}
		return redirect()->back()->with('login_message','Please check your email and password.');

	}

	public function signup(){
		return view('user.signup');
	}

	public function postSignup(Request $request){
	
		$this->validate($request,[
			'email'=>'email|required|unique:users',
			'password'=>'|required|min:3'
		]);

		$user = new User([
			'email'=>$request->email,
			'password'=>bcrypt($request->password)
		]);
		$user->save();

		Auth::login($user);

		return redirect()->route('user.profile')->with('message','Successfully created an account. Try to log in.');

	}

	public function logout(){
		Auth::logout();
		return redirect()->route('user.signin');
	}

}
