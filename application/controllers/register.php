<?php

class Register_Controller extends Base_Controller
{
    public function action_index()
    {
        $listCourse = Course::all();
        $selectArray = array();
        foreach($listCourse as $course){
            $selectArray[$course->id] = strtoupper($course->code);
        }
        return View::make('forms.register')
            ->with('courses', $selectArray)
            ->with('isNew', true);
    }

    public function action_createuser()
    {
        $new_user = array(
            'username' => array('forename'=>Input::get('forename'), 'surname'=>Input::get('surname')),
            'fName' => Input::get('forename'),
            'sName' => Input::get('surname'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'email' => Input::get('email'),
            'role' => Input::get('role'));
        $rules = array(
            'fName' => 'required|alpha',
            'sName' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5');
        $v = Validator::make($new_user, $rules);
        if($v->fails()){
            return Redirect::to(URL::to_action('register'))
                ->with_errors($v)
                ->with_input();
        }
        unset($new_user['password_confirmation']);
        $user = new User($new_user);
        $user->save();

        $new_enrollment = array(
            'user_id' => $user->id,
            'course_id' => Input::get('enrollment')
        );
        $enrol = new Enrollment($new_enrollment);
        $enrol->save();

        $password = Input::get('password');
        $userdata = array(
            'username' => $user->username,
            'password' => $password);
        if(Auth::attempt($userdata)){
            return Redirect::to('/');
        }
    }
}
