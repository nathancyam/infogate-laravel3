<?php

class Admin_Users_Controller extends Base_Controller
{
	public function __construct(){
		parent::__construct();
		$this->filter('before','auth');
	}

	public function action_index()
	{
		$table = array();
		$users = User::all();
		foreach($users as $user){
			$userrole = $user->role;
			switch($userrole){
				case "admin":
					$userlabel = Label::important("Admin");
					break;
				case "coordinator":
					$userlabel = Label::success("Coordinator");
					break;
				case "teacher":
					$userlabel = Label::info("Teacher");
					break;
				case "student":
					$userlabel = Label::inverse("Student");
					break;
				default:
					$userlabel = "";
					break;
			}
			$editUser = HTML::link_to_action('admin.users@edit','Edit',array($user->id));
			$row = array(
						'fname' => $user->fname,
						'sname' => $user->sname,
						'email' => $user->email,
						'role' => $userlabel,
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
			switch($role){
				case "admin":
					$userlabel = Label::important("Admin");
					break;
				case "coordinator":
					$userlabel = Label::success("Coordinator");
					break;
				case "teacher":
					$userlabel = Label::info("Teacher");
					break;
				case "student":
					$userlabel = Label::inverse("Student");
					break;
				default:
					$userlabel = "";
					break;
			}
			$editUser = HTML::link_to_action('admin.users@edit','Edit',array($user->id));
			$row = array(
						'fname' => $user->fname,
						'sname' => $user->sname,
						'email' => $user->email,
						'role' => $userlabel,
						'link' => $editUser);
			array_push($table, $row);
		}
		return View::make('template.usertable')
			->with('table', $table);
	}

	public function action_edit($user_id)
	{
		$editUser = User::find($user_id);
	}
}