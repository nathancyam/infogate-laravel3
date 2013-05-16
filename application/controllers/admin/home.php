<?php

class Admin_Home_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->filter('before','auth');
		$this->filter('before','admin');
	}

	public function action_index()
	{
		return View::make('admin.panel');
	}

}
