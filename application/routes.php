<?php

Route::get('/', function()
{
	return View::make('home.index');
});

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

Route::filter('before', function()
{
    // Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
    // Do stuff after every request to your application...
});

View::composer('template.navigation', function($view){
    $enrollCourse = User::find(Auth::user()->id)->enrollment()->first();
    $courseCode = $enrollCourse->course()->first();
    $subjects = $courseCode->subjects()->get();
    $data = array(
        'code' => $courseCode->code,
        'subjects' => $subjects
    );
    $view->with($data);
});

Route::filter('csrf', function()
{
    if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::to('login');
});

Route::filter('admin', function(){
    $user = Auth::user();
    if($user->role !== 'admin'){
        return Redirect::to('login');
    }
});

Route::controller('account');

Route::get('superwelcome/(:any)/(:any)', 'account@welcome');

Route::get('login', function(){
    return View::make('main.login');
});

Route::post('login', function(){
    $userdata = array(
        'username'=>Input::get('username'),
        'password'=>Input::get('password')
    );
    if(Auth::attempt($userdata)){
        return Redirect::to('/');
    } else {
        return Redirect::to('login')
            ->with('login_errors', true);
    }
});

Route::get('logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Route::get('user/new', array('as'=>'newuser', 'do'=>function(){
    return View::make('forms.register');
}));

Route::post('user/new', function(){
    $passwordcheck = Input::get('passwordcheck');
    $password = Input::get('password');
    if($passwordcheck !== $password){
        return Redirect::to('user/new');
    }
    $surname = Input::get('sName');
    $forename = Input::get('fName');
    $username = strtolower(substr($forename,0,2).substr($surname,0,4));
    $new_user = array(
        'username' => $username,
        'fName' => Input::get('fName'),
        'sName' => Input::get('sName'),
        'password' => Hash::make(Input::get('password')),
        'email' => Input::get('email')
    );
    $rules = array(
        'fName' => 'required',
        'sName' => 'required',
        'password' => 'required'
    );
    $v = Validator::make($new_user, $rules);
    if($v->fails()){
        return Redirect::to('user/new')
            ->with_errors($v)
            ->with_input();
    }
    $user = new User($new_user);
    $user->save();
    return Redirect::to('courses');
});

Route::group(array('before'=>'auth|admin'), function(){

    // =================== COURSES ===================
    // List all the course
    Route::get('courses', array('as'=>'listcourses', 'do'=>function(){
        $courses = Course::with('coordinator_id')->all();
        return View::make('main.courses')
            ->with('courses',$courses);
    }));

    // Show the new course form
    Route::get('course/new', array('as'=>'newcourse', 'do'=>function(){
        $isNew = true;
        $user = Auth::user();
        return view::make('forms.course')
            ->with('isNew', $isNew)
            ->with('user', $user);
    }));

    // Create a new course
    Route::post('course/new', array('as'=>'postcourse', 'do'=>function(){
        $new_course = array(
            'name' => Input::get('name'),
            'code' => Input::get('code'),
            'coordinator_id' => Input::get('coordinator_id')
        );
        $course = new Course($new_course);
        $course->save();
        return Redirect::to('courses');
    }));

    Route::get('course/(:any)/edit', array('as'=>'editcourse', 'do'=>function($code){
        $isNew = false;
        $user = Auth::user();
        $get_course = Course::where('code','=',$code)->first();
        $data = array(
            'user' => $user,
            'isNew' => $isNew,
            'name' => $get_course->name,
            'code' => $get_course->code);
        return View::make('forms.course', $data);
    }));

    Route::put('course/(:any)/edit', function($code){
        $new_course = Course::where('code','=',$code)->first();
        $new_course->name = Input::get('name');
        $new_course->code = Input::get('code');
        $new_course->save();
        return View::make(URL::to_route('listcourses'));
    });

    // =================== SUBJECT ===================

    // List all subjects for a course
    Route::get('(:any)/subjects', array('as'=>'listsubjects', 'do'=>function($course){
        $query = Course::where('code','=',$course)->first();
        $subjects = Subject::where('course_id','=',$query->id)->get();

        $data = array(
                'subjects' => $subjects,
                'code' => $course
            );
        return View::make('main.subjects', $data);
    }));

    // Show the new subject form
    Route::get('(:any)/subject/new', array('as'=>'newsubject', 'do'=>function($course){
        $query = Course::where('code','=',$course)->first();
        return View::make('forms.subject')
            ->with('isNew', true)
            ->with('course', $query);
    }));

    // Create a new subject for the course in the URI
    Route::post('(:any)/subject/new', array('before'=>'auth', 'do'=>function($course){
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
    }));

    Route::get('(:any)/subject/(:any)/edit', array('as'=>'editsubject', 'do'=>function($course, $subject){
        $query = Course::where('code','=',$course)->first();
        $editSubject = Subject::where('code','=',$subject)->first();
        return View::make('forms.subject')
            ->with('course', $query)
            ->with('isNew', false)
            ->with('info', $editSubject);
    }));

    Route::put('(:any)/subject/(:any)/edit', function($course, $subject){
        $new_subject = Subject::where('code','=',$subject)->first();
        $new_subject->name = Input::get('name');
        $new_subject->description = Input::get('description');
        $new_subject->code = Input::get('code');
        $new_subject->save();
        return View::make('listsubjects', array($course));
    });

    // =================== TOPICS ===================

    // List all topics
    Route::get('(:any)/(:any)/topics', array('as'=>'listtopics', 'do'=>function ($course, $subject){
        $linkCourse = Course::where('code','=',$course)->first();
        $linkSubject = Subject::where('code','=',$subject)->first();
        $topics = Topic::where('subject_id','=',$linkSubject->id)->get();

        $data = array(
            'isNew' => true,
            'course' => $linkCourse,
            'subject' => $linkSubject,
            'topics' => $topics
        );
        return View::make('main.topics', $data);
    }));

    // Show the new topic form for the course in the URI
    Route::get('(:any)/(:any)/topic/new', function($course, $subject){
        $details = Subject::where('code','=',$subject)->first();
        $data = array(
            'course' => $course,
            'subject' => $details
        );
        return View::make('forms.topic',$data);
    });

    // Create a new topic for the topic in the URI
    Route::post('(:any)/(:any)/topic/new', array('as'=>'newtopic','do'=>function($course, $subject){
        $new_topic = array(
            'name' => Input::get('name'),
            'content' => Input::get('content'),
            'subject_id' => Input::get('subject_id')
        );
        $rules = array(
                'name' => 'required',
                'content' => 'required',
        );
        $v = Validator::make($new_topic, $rules);
        if($v->fails()){
            return Redirect::to(URL::current())
                ->with_errors($v)
                ->with_input();
        }
        $topic = new Topic($new_topic);
        $topic->save();
        return Redirect::to(URL::to_route('listtopics', array($course, $subject)));
    }));

    Route::get('(:any)/(:any)/topic/(:num)/edit', array('as'=>'edittopic','do'=>function($course, $subject, $topic){
        $query = Topic::find($topic);
        $subjectObj = $query->subject()->first();
        return View::make('forms.topic')
            ->with('isNew', false)
            ->with('subject', $subjectObj)
            ->with('info', $query);
    }));

    Route::put('(:any)/(:any)/topic/(:num)/edit', function($course, $subject, $topic){
        $updated_topic = Topic::find($topic);
        $updated_topic->name = Input::get('name');
        $updated_topic->content = Input::get('content');
        $updated_topic->save();
        return View::make(URL::to_route('listtopics', array($course, $subject)));
    });
});

Route::group(array('before'=>'auth'), function(){

    // =================== POSTS ===================
    // List all posts
    Route::get('(:any)/(:any)/(:any)/posts', array('as'=>'listposts', 'do'=>function ($course, $subject, $topic){
        $linkTopic = Topic::find($topic);
        $posts = Post::where('topic_id','=',$linkTopic->id)->get();
        $data = array(
            'course' => $course,
            'subject' => $subject,
            'topic' => $topic,
            'posts' => $posts);
        return View::make('main.posts', $data);
    }));

    // Show the new post form for the topic in the URI
    Route::get('(:any)/(:any)/(:any)/posts/new', function($course, $subject, $topic_id){
        $user = Auth::user();
        $topic = Topic::find($topic_id);
        $data = array(
            'isNew' => true,
            'user' => $user,
            'topic' => $topic
        );
        return View::make('forms.post',$data);
    });

    // Create a new post for the topic in the URI
    Route::post('(:any)/(:any)/(:any)/posts/new', array('as'=>'newpost','do'=>function($course, $subject, $topic){
        $new_post = array(
            'title' => Input::get('title'),
            'body' => Input::get('body'),
            'topic_id' => Input::get('topic_id'),
            'author_id' => Input::get('author_id')
        );
        $rules = array(
            'body' => 'required'
        );
        $v = Validator::make($new_post, $rules);
        if($v->fails()){
            return Redirect::to(URL::current())
                ->with_errors($v)
                ->with_input();
        }
        $post = new Post($new_post);
        $post->save();
        return Redirect::to(URL::to_route('listposts', array($course, $subject, $topic)));
    }));

    Route::get('(:any)/(:any)/(:num)/post/(:num)/edit', array('as'=>'editpost', 'do'=>function($course, $subject, $topic_id, $post_id){
        $edit_Post = Post::find($post_id);
        $this_topic = $edit_Post->topic()->first();
        $user = Auth::user();
        $data = array(
            'isNew' => false,
            'user' => $user,
            'topic' => $this_topic,
            'post' => $edit_Post);
        return View::make('forms.post', $data);
    }));

    Route::put('(:any)/(:any)/(:num)/post/(:num)/edit', function($course, $subject, $topic_id, $post_id){
        $updated_post = Post::find($post_id);
        $updated_post->title = Input::get('title');
        $updated_post->body = Input::get('body');
        $updated_post->save();
        return View::make(URL::to_route('listposts',array($course, $subject, $topic_id)));
    });
});

