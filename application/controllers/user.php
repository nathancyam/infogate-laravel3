<?php

class User_Controller extends Base_Controller
{
	public function action_login()
	{
		return View::make('main.login');
	}

	public function action_check()
	{
		$userdata = array(
	        'username'=>Input::get('username'),
	        'password'=>Input::get('password'));
	    $rules = array(
	        'username' => 'required',
	        'password' => 'required'
	    );
	    $validation = Validator::make($userdata, $rules);
	    if($validation->fails()){
	        return Redirect::to('login')->with_errors($validation);
	    }
	    if(Auth::attempt($userdata)){
	        return Redirect::to('/');
	    } else {
	        return Redirect::to('/');
		}
	}
	
	public function action_logout()
	{
		Auth::logout();
	    return Redirect::to('/');
	}
}