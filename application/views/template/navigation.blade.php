<?php

$navArray = array(
        array(Navigation::HEADER, 'Navigation'),
        array('User Panel', URL::to_action('account'), false, false, null, 'off'));

if (Auth::user()->role == 'admin'){
    array_push($navArray, array(Navigation::HEADER, 'Admin Panel'));
    array_push($navArray, array('Admin Home', URL::to_action('admin'), false, false, null, 'lock' ));
    array_push($navArray, array('Courses', URL::to_route('listcourses'), false, false, null, 'list-alt'));
    array_push($navArray, array('Users', URL::to_action('admin@users'), false, false, null, 'user' ));
}

array_push($navArray, array(Navigation::HEADER, 'Courses'));
array_push($navArray, array(strtoupper($code), URL::to_route('listsubjects', array($code)), false, false, null, 'briefcase'));

array_push($navArray, array(Navigation::HEADER, 'Subjects for ' . strtoupper($code)));
foreach($subjects as $subject){
    array_push($navArray, array(strtoupper($subject->code), URL::to_route('listtopics', array($code, $subject->code)), false, false, null, 'pencil'));
}

array_push($navArray, array(Navigation::HEADER, 'Help'));
array_push($navArray, array('Help', URL::to_route('help'), false, false, null, 'question-sign'));

echo Navigation::lists(Navigation::links($navArray), true, array('data-spy'=>'affix', 'data-offset-top'=>'250'));
