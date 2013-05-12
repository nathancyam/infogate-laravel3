<?php

class Account_Controller extends Base_Controller {

    public function action_index()
    {
        return View::make('user.index');
    }

    public function action_courses()
    {
        $user = Auth::user()->id;
        $courses = Enrollment::where('user_id','=',$user)->first()->course()->first();
        $subjects = $courses->subjects()->get();
        $data = array(
            'courses' => $courses,
            'subjects' => $subjects);
        return View::make('user.course', $data);
    }

    public function action_info()
    {
        $user = User::find(Auth::user()->id);
        return View::make('user.userinfo')
            ->with('user', $user);
    }

    public function action_update()
    {
        $user = User::find(Auth::user()->id);
        return View::make('forms.register')
            ->with('isNew', false)
            ->with('user', $user);
    }

    public function action_postupdate()
    {
        $new_user_details = array(
            'fName' => Input::get('fName'),
            'sName' => Input::get('sName'),
            'email' => Input::get('email'));
        $rules = array(
            'fName' => 'required',
            'sName' => 'required',
            'email' => 'required'
        );
        $valid = Validator::make($new_user_details, $rules);
        if($valid->fails())
        {
            return Redirect::to(URL::to_action('account@update'))
                ->with_errors($valid)
                ->with_input();
        }
        $new_user = User::find(Auth::user()->id);
        $new_user->fname = Input::get('fName');
        $new_user->sname = Input::get('sName');
        $new_user->email = Input::get('email');
        $new_user->save();
        return Redirect::to(URL::to_action('account@info'));
    }
}
