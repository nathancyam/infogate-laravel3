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
    if($enrollCourse){
        $courseCode = $enrollCourse->course()->first();
        $subjects = $courseCode->subjects()->get();
        $data = array(
            'code' => $courseCode->code,
            'subjects' => $subjects
        );
        $view->with($data);
    } else {
        $view;
    }
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
    $user = User::find(Auth::user()->id);
    switch($user->role){
        case 'admin':
            break;
        case 'coordinator':
            $isCoord = $user->enrollment()->course()->first();
            if($isCoord->coordinator_id !== $user->id){
                return Redirect::to('/');
            }
            break;
        case 'teacher':
            return Redirect::to('/');
            break;
        case 'student':
            return Redirect::to('/');
            break;
        default:
            return Redirect::to('/');
            break;
    }
});

Route::filter('onlyadmin', function(){
    $user = User::find(Auth::user()->id);
    if($user->role !== 'admin'){
        return Redirect::to('/');
    }
});

Event::listen('isCoord', function($user){
    if($user->role == 'admin'){
        return true;
    } elseif ($user->role == 'coordinator'){
        $iamthecoordinator = $user->enrollment()->first()->course()->first()->coordinator_id;
        if($user->id == $iamthecoordinator){
            return true;
        }
    }
    return false;
});

Route::controller(Controller::detect());

// =================== NOTES ===================
// All filtering for the routes are found in the controllers construct methods

// =================== ROUTE + CONTROLLER RULES ===================
// controller@index = Goes to the list of items defined by the user
// controller@new = Creates a new item
// controller@add = Adds the new item to the database
// controller@edit = Opens a form for the user to edit the item
// controller@update = Saves the edited item to the database

// =================== USER LOGIN ===================
Route::get('help', array('as'=>'help', function(){
    return View::make('main.help');
}));

Route::get('login', 'user@login');
Route::post('login', array('as'=>'postLogin', 'uses'=>'user@check'));
Route::get('logout', 'user@logout');

// =================== COURSES ===================
Route::get('courses', array('as'=>'listcourses', 'uses'=>'course@index'));
Route::get('course/new', array('as'=>'newcourse', 'uses'=>'course@new'));
Route::post('course/new', array('as'=>'postcourse', 'uses'=>'course@add'));
Route::get('course/(:any)/edit', array('as'=>'editcourse', 'uses'=>'course@edit'));
Route::put('course/(:any)/edit', array('as'=>'updatecourse', 'uses'=>'course@update'));

// =================== SUBJECT ===================
Route::get('(:any)/subjects', array('as'=>'listsubjects', 'uses'=>'subject@index'));
Route::get('(:any)/subject/new', array('as'=>'newsubject', 'uses'=>'subject@new'));
Route::post('(:any)/subject/new', array('as'=>'addsubject', 'uses'=>'subject@add'));
Route::get('(:any)/subject/(:any)/edit', array('as'=>'editsubject', 'uses'=>'subject@edit'));
Route::put('(:any)/subject/(:any)/edit', array('as'=>'updatesubject', 'uses'=>'subject@update'));
Route::get('(:any)/subject/(:any)/delete', array('as'=>'deletesubject', 'uses'=>'subject@delete'));

// =================== TOPICS ===================
Route::get('(:any)/(:any)/topics', array('as'=>'listtopics', 'uses'=>'topic@index'));
Route::get('(:any)/(:any)/topic/new', array('as'=>'newtopic','uses'=>'topic@new'));
Route::post('(:any)/(:any)/topic/new', array('as'=>'newtopic','uses'=>'topic@add'));
Route::get('(:any)/(:any)/topic/(:num)/edit', array('as'=>'edittopic','uses'=>'topic@edit'));
Route::put('(:any)/(:any)/topic/(:num)/edit', array('as'=>'updatetopic', 'uses'=>'topic@update'));

// =================== POSTS ===================
Route::get('(:any)/(:any)/(:any)/posts', array('as'=>'listposts', 'uses'=>'post@index'));
Route::get('(:any)/(:any)/(:any)/posts/drafts', array('as'=>'listdrafts', 'uses'=>'post@drafts'));
Route::get('(:any)/(:any)/(:any)/posts/new', array('as'=>'posts', 'uses'=>'post@new'));
Route::post('(:any)/(:any)/(:any)/posts/new', array('as'=>'newpost','uses'=>'post@add'));
Route::get('(:any)/(:any)/(:num)/post/(:num)/edit', array('as'=>'editpost', 'uses'=>'post@edit'));
Route::put('(:any)/(:any)/(:num)/post/(:num)/edit', array('as'=>'updateposts', 'uses'=>'post@update'));
Route::put('(:any)/(:any)/(:num)/post/(:num)/approve', array('as'=>'approvepost', 'uses'=>'post@approve'));
Route::get('(:any)/(:any)/(:num)/post/(:num)/delete', array('as'=>'deletepost', 'uses'=>'post@delete'));

