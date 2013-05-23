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
            'username' => array('forename'=>Input::get('fName'), 'surname'=>Input::get('sName')),
            'fName' => Input::get('forename'),
            'sName' => Input::get('surname'),
            'password' => Input::get('password'),
            'email' => Input::get('email'),
            'role' => Input::get('role'));
        $rules = array(
            'fName' => 'required|alpha',
            'sName' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed'
        );
        $v = Validator::make($new_user, $rules);
        if($v->fails()){
            var_dump($v);
            return Redirect::to(URL::to_action('register'))
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
