<?php

class Admin_Users_Controller extends Base_Controller
{
	public function action_index()
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

	public function action_role($role)
	{
		$table = array();
		$users = User::where('role','=',$role)->get();
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