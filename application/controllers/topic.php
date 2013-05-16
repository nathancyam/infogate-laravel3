<?php

class Topic_Controller extends Base_Controller
{
	public function __construct(){
		parent::__construct();
		$this->filter('before','auth');
		$this->filter('before','admin')->only('new','add','edit','update');
	}

	public function action_index($course, $subject)
	{
		$linkCourse = Course::where('code','=',$course)->first();
        $linkSubject = Subject::where('code','=',$subject)->first();
        $topics = Topic::where('subject_id','=',$linkSubject->id)->get();

        $data = array(
            'isNew' => true,
            'course' => $linkCourse,
            'subject' => $linkSubject,
            'topics' => $topics);
        return View::make('main.topics', $data);
	}

	public function action_new($course, $subject)
	{
		$details = Subject::where('code','=',$subject)->first();
        $data = array(
            'isNew' => true,
            'course' => $course,
            'subject' => $details);
        return View::make('forms.topic',$data);	
	}

	public function action_add($course, $subject)
	{
        $new_topic = array(
            'name' => Input::get('name'),
            'content' => Input::get('content'),
            'subject_id' => Input::get('subject_id'));
        $rules = array(
                'name' => 'required',
                'content' => 'required');
        $v = Validator::make($new_topic, $rules);
        if($v->fails()){
            return Redirect::to(URL::current())
                ->with_errors($v)
                ->with_input();
        }
        $topic = new Topic($new_topic);
        $topic->save();
        return Redirect::to(URL::to_route('listtopics', array($course, $subject)));
	}

	public function action_edit()
	{
        $query = Topic::find($topic);
        $subjectObj = $query->subject()->first();
        return View::make('forms.topic')
            ->with('isNew', false)
            ->with('subject', $subjectObj)
            ->with('info', $query);
	}

	public function action_update()
	{
        $updated_topic = Topic::find($topic);
        $updated_topic->name = Input::get('name');
        $updated_topic->content = Input::get('content');
        $updated_topic->save();
        return Redirect::to(URL::to_route('listtopics', array($course, $subject)));
	}
}