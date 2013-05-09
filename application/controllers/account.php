<?php

class Account_Controller extends Base_Controller {

    /*
        |--------------------------------------------------------------------------
        | The Default Controller
        |--------------------------------------------------------------------------
        |
        | Instead of using RESTful routes and anonymous functions, you might wish
        | to use controllers to organize your application API. You'll love them.
        |
        | This controller responds to URIs beginning with "home", and it also
        | serves as the default controller for the application, meaning it
        | handles requests to the root of the application.
        |
        | You can respond to GET requests to "/home/profile" like so:
        |
        |		public function action_profile()
        |		{
            |			return "This is your profile!";
            |		}
            |
            | Any extra segments are passed to the method as parameters:
            |
            |		public function action_profile($id)
            |		{
                |			return "This is the profile for user {$id}.";
                |		}
                |
     */

    public function action_index()
    {
        echo "This is a profile page";
    }
    public function action_welcome($name, $place)
    {
        // These are 3 ways to populate a View from a controller
        //echo "Welcome {$name} to {$place}.";
        //return View::make('welcome')
            //->with('name', $name)
            //->with('place', $place);
        $data = array(
            'name' => $name,
            'place'=> $place
        );
        return View::make('welcome',$data);
    }
    public function action_login(){
        echo "This is a login form";
    }
    public function action_logout(){
        echo "This is a logout page";
    }
}
