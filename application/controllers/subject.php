<?php

class Subject_Controller extends Base_Controller
{
    public function __construct(){
        parent::__construct();
        $this->filter('before','auth');
        $this->filter('before','admin')->only('add','new','edit','update','delete');
    }

    public function action_index($course)
    {
        $query = Course::where('code','=',$course)->first();
        $subjects = Subject::where('course_id','=',$query->id)->get();
        $data = array(
                'subjects' => $subjects,
                'code' => $query
            );
        return View::make('main.subjects', $data);
    }

    public function action_new($course)
    {
        $query = Course::where('code','=',$course)->first();
        return View::make('forms.subject')
            ->with('isNew', true)
            ->with('course', $query);
    }

    public function action_add($course)
    {
        $new_subject = array(
            'code' => Input::get('code'),
            'name' => Input::get('name'),
            'description' => Input::get('description'),
            'course_id' => Input::get('course_id')
        );
        $rules = array(
                'code' => 'required',
                'name' => 'required',
                'description' => 'required'
        );
        $v = Validator::make($new_subject, $rules);
        if($v->fails()){
            return Redirect::to(URL::current())
                ->with_errors($v)
                ->with_input();
        }
        $subject = new Subject($new_subject);
        $subject->save();
        return Redirect::to(URL::to_route('listsubjects', array($course)));
    }

    public function action_edit($course, $subject)
    {
        $query = Course::where('code','=',$course)->first();
        $editSubject = Subject::where('code','=',$subject)->first();
        return View::make('forms.subject')
            ->with('course', $query)
            ->with('isNew', false)
            ->with('info', $editSubject);
    }

    public function action_update($course, $subject)
    {
        $new_subject = Subject::where('code','=',$subject)->first();
        $new_subject->name = Input::get('name');
        $new_subject->description = Input::get('description');
        $new_subject->code = Input::get('code');
        $new_subject->save();
        return Redirect::to(URL::to_route('listsubjects', array($course)));
    }

    public function action_delete($course, $subject_id)
    {
        $topics = Subject::find($subject_id)->topics()->get();
        foreach($topics as $topic){
            $topic->posts()->delete();
        }
        Subject::find($subject_id)->topics()->delete();
        Subject::find($subject_id)->delete();
        return Redirect::to(URL::to_route('listsubjects', array($course)));
    }
}
