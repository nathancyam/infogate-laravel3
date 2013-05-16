<?php

$navArray = array(
        array(Navigation::HEADER, 'Navigation'),
        array('Home', URL::base()),
        array('User Panel', URL::to_action('account')),
        array('Applications', '#'));

if (Auth::user()->role == 'admin'){
    array_push($navArray, array(Navigation::HEADER, 'Admin Panel'));
    array_push($navArray, array('Admin Home', URL::to_action('admin')));
    array_push($navArray, array('Courses', URL::to_route('listcourses')));
    array_push($navArray, array('Users', URL::to_action('admin@users')));
}

array_push($navArray, array(Navigation::HEADER, 'Courses'));
array_push($navArray, array(strtoupper($code), URL::to_route('listsubjects', array($code))));

array_push($navArray, array(Navigation::HEADER, 'Subjects for ' . strtoupper($code)));
foreach($subjects as $subject){
    array_push($navArray, array(strtoupper($subject->code), URL::to_route('listtopics', array($code, $subject->code))));
}

echo Navigation::lists( Navigation::links($navArray));
