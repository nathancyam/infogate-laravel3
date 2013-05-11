<?php
$navArray = array(
        array(Navigation::HEADER, 'Navigation'),
        array('Home', URL::base()),
        array('Library', '#'),
        array('Applications', '#'));

if (Auth::user()->role == 'admin'){
    array_push($navArray, array(Navigation::HEADER, 'Admin Panel'));
    array_push($navArray, array('Courses', URL::to_route('listsubjects', array($code))));
}

array_push($navArray, array(Navigation::HEADER, 'Courses'));
array_push($navArray, array(strtoupper($code), '#'));

array_push($navArray, array(Navigation::HEADER, 'Subjects for ' . $code));
foreach($subjects as $subject){
    array_push($navArray, array(strtoupper($subject->code), URL::to_route('listtopics', array($code, $subject->code))));
}

echo Navigation::lists( Navigation::links($navArray));
