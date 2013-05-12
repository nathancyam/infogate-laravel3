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
        $surname = Input::get('sName');
        $forename = Input::get('fName');
        $username = strtolower(substr($forename,0,2).substr($surname,0,4));
        $new_user = array(
            'username' => $username,
            'fName' => Input::get('fName'),
            'sName' => Input::get('sName'),
            'password' => Input::get('password'),
            'email' => Input::get('email')
        );
        $rules = array(
            'fName' => 'required',
            'sName' => 'required',
            'password' => 'required'
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
            'user_id' => User::where('username','=',$username)->first()->id,
            'course_id' => Input::get('enrollment')
        );
        $enrol = new Enrollment($new_enrollment);
        $enrol->save();

        $userdata = array(
            'username' => $username,
            'password' => $password);
        if(Auth::attempt($userdata)){
            return Redirect::to('/');
        }
    }
}
