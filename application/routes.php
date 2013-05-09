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

Route::filter('csrf', function()
{
    if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::to('login');
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
        return Redirect::to('courses');
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

// =================== COURSES ===================

// List all the course
Route::get('courses', function(){
    $courses = Course::with('coordinator_id')->all();
    return View::make('main.index')
        ->with('courses',$courses);
});

// Show the new course form
Route::get('course/new', array('before'=>'auth', 'as'=>'newcourse', 'do'=>function(){
    $user = Auth::user();
    if($user->role !== 'admin'){
        return Redirect::to('/');
    }
    return View::make('forms.course')
        ->with('user', $user);
}));

// Create a new course
Route::post('course/new', array('before'=>'auth', 'do'=>function(){
    $new_course = array(
        'name' => Input::get('name'),
        'code' => Input::get('code'),
        'coordinator_id' => Input::get('coordinator_id')
    );
    $course = new Course($new_course);
    $course->save();
    return Redirect::to('courses');
}));

// =================== END COURSES ===================

// =================== SUBJECT ===================

// List all subjects for a course
Route::get('(:any)/subjects', array('as'=>'listsubjects', 'do'=>function($course){
    $query = Course::where('code','=',$course)->first();
    $subjects = Subject::where('course_id','=',$query->id)->get();
    return View::make('main.subjects')
        ->with('subjects', $subjects);
}));

// Show the new course form
Route::get('(:any)/subject/new', array('before'=>'auth', 'as'=>'newsubject', 'do'=>function($course){
    $query = Course::where('code','=',$course)->first();
    return View::make('forms.subject')
        ->with('course', $query);
}));

// Create a new subject for the course in the URI
Route::post('(:any)/subject/new', array('before'=>'auth', 'do'=>function($course){
    $new_subject = array(
        'name' => Input::get('name'),
        'description' => Input::get('description'),
        'course_id' => Input::get('course_id')
    );
    $subject = new Subject($new_subject);
    $subject->save();
    return Redirect::to('courses');
}));

// =================== TOPICS ===================

// List all topics
Route::get('(:any)/(:any)/topics', array('as'=>'listtopics', 'do'=>function ($course, $subject){
    $linkCourse = Course::where('code','=',$course)->first();
    $linkSubject = Subject::where('course_id','=',$linkCourse->id)->first();
    $topics = Topic::where('subject_id','=',$linkSubject->id)->get();

    $data = array(
        'course' => $linkCourse,
        'subject' => $linksubject,
        'topics' => $topics
    );
    return View::make('main.topics', $data);
}));

// Show the new topic form for the course in the URI
Route::get('(:any)/(:any)/topic/new', function($course, $subject){
    $data = array(
        'course' => $course,
        'subject' => $subject
    );
    return View::make('forms.topic',$data);
});

// Create a new topic for the topic in the URI
Route::post('(:any)/(:any)/topic/new', array('as'=>'newtopic','do'=>function($course, $subject){
    $data = array(
        'name' => Input::get('name'),
        'content' => Input::get('content'),
        'subject_id' => Input::get('subject')
    );
    $topic = new Topic($data);
    $topic->save();
    return Redirect::to('courses');
}));

// =================== END TOPICS ===================

// =================== POSTS ===================

// List all posts
Route::get('(:any)/(:any)/(:any)/posts', array('as'=>'listposts', 'do'=>function ($course, $subject, $topic){
    $linkTopic = Topic::find($topic);
    $posts = Post::where('topic_id','=',$linkTopic->id)->get();

    return View::make('main.posts')
        ->with('posts', $posts);
}));

// Show the new post form for the topic in the URI
Route::get('(:any)/(:any)/(:any)/post/new', function($course, $subject, $topic_id){
    $user = Auth::user();
    $topic = Topic::find($topic_id);

    $data = array(
        'user' => $user,
        'topic' => $topic
    );

    return View::make('forms.post',$data);
});

// Create a new post for the topic in the URI
Route::post('(:any)/(:any)/(:any)/post/new', array('as'=>'newpost','do'=>function($course, $subject, $topic){
    $data = array(
        'title' => Input::get('title'),
        'body' => Input::get('body'),
        'topic_id' => Input::get('topic_id'),
        'author_id' => Input::get('author_id')
    );
    $post = new Post($data);
    $post->save();
    return Redirect::to('courses');
}));

// =================== END POSTS ===================
