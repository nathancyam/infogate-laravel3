<?php

class Admin_Users_Controller extends Base_Controller
{
	public function __construct(){
		parent::__construct();
		$this->filter('before','auth');
	}

	public function action_index()
	{
		$editUser = HTML::link_to_action('course');
		$table = array();
		$users = User::all();
		foreach($users as $user){
			$row = array(
						'fname' => $user->fname,
						'sname' => $user->sname,
						'email' => $user->email,
						'role' => $user->role,
						'link' => $editUser);
			array_push($table, $row);
		}
		return View::make('admin.users')
			->with('table', $table);
	}

	// Here we use AJAX to populate the tables. See the appropriate Javascript
	public function action_role($role)
	{
		$editUser = HTML::link_to_action('course');
		$table = array();
		$users = User::where('role','=',$role)->get();
		foreach($users as $user){
			$row = array(
						'id' => $user->id,
						'fname' => $user->fname,
						'sname' => $user->sname,
						'email' => $user->email,
						'role' => $user->role,
						'link' => $editUser);
			array_push($table, $row);
		}
		return View::make('template.usertable')
			->with('table', $table);
	}

	public function action_edit($user)
	{

	}
}