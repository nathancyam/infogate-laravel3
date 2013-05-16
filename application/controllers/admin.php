<?php

class Admin_Controller extends Base_Controller
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

	public function action_users()
	{
		$table = array();
		$users = User::all();
		foreach($users as $user){
			$row = array(
						'fname' => $user->fname,
						'sname' => $user->sname,
						'email' => $user->email,
						'role' => $user->role);
			array_push($table, $row);
		}
		return View::make('admin.users')
			->with('table', $table);
	}
}
