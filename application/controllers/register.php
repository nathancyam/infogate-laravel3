<?php

class Register_Controller extends Base_Controller
{
    public function action_index()
    {
        $listCourse = Course::all();
        $selectArray = array();
        foreach($listCourse as $course){
            $selectArray[$course->id] = $course->code;
        }
        return View::make('forms.register')
            ->with('courses', $selectArray)
            ->with('isNew', true);
    }

    public function action_createuser()
    {
        $passwordcheck = Input::get('passwordcheck');
        $password = Input::get('password');
        if($passwordcheck !== $password){
            return Redirect::to(URL::to_action('register@index'))
                ->with_input();
        }
        $new_user = array(
            'username' => array('forename'=>Input::get('fName'), 'surname'=>Input::get('sName')),
            'fName' => Input::get('fName'),
            'sName' => Input::get('sName'),
            'password' => Input::get('password'),
            'email' => Input::get('email'),
            'role' => Input::get('role'));
        $rules = array(
            'fName' => 'required|alpha',
            'sName' => 'required|alpha',
            'email' => 'required|alpha',
            'password' => 'required|min:5'
        );
        $v = Validator::make($new_user, $rules);
        if($v->fails()){
            return Redirect::to(URL::to_action('register@index'))
                ->with_errors($v)
                ->with_input();
        }
        $user = new User($new_user);
        $user->save();

        $new_enrollment = array(
            'user_id' => $user->id,
            'course_id' => Input::get('enrollment')
        );
        $enrol = new Enrollment($new_enrollment);
        $enrol->save();

        $userdata = array(
            'username' => $user->username,
            'password' => $password);
        if(Auth::attempt($userdata)){
            return Redirect::to('/');
        }
    }
}
