<?php

class Course_Controller extends Base_Controller
{
	public function __construct(){
		parent::__construct();
		$this->filter('before','auth');
		$this->filter('before','admin')->only('add','new','edit','update');
	}

	public function action_index()
	{
        $courses = Course::all();
        return View::make('main.courses')
            ->with('courses',$courses);
	}

	public function action_new()
	{
        $isNew = true;
        $user = Auth::user();
        return view::make('forms.course')
            ->with('isNew', $isNew)
            ->with('user', $user);
	}

	public function action_add()
	{
        $new_course = array(
            'name' => Input::get('name'),
            'code' => strtoupper(Input::get('code')),
            'coordinator_id' => Input::get('coordinator_id')
        );
        $course = new Course($new_course);
        $course->save();
        return Redirect::to('courses');
	}

	public function action_edit($code)
	{
        $isNew = false;
        $user = Auth::user();
        $get_course = Course::where('code','=',$code)->first();
        $data = array(
            'user' => $user,
            'isNew' => $isNew,
            'name' => $get_course->name,
            'code' => $get_course->code);
        return View::make('forms.course', $data);
    }

    public function action_update($code)
    {
        $new_course = Course::where('code','=',$code)->first();
        $new_course->name = Input::get('name');
        $new_course->code = Input::get('code');
        $new_course->save();
        return Redirect::to(URL::to_route('listcourses'));
    }

    public function action_delete($code)
    {
        $new_course = Course::where('code','=',$code)->delete();
    }
}