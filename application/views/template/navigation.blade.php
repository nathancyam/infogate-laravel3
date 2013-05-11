<?php
$navArray = array(
        array(Navigation::HEADER, 'Navigation'),
        array('Home', URL::base()),
        array('Library', '#'),
        array('Applications', '#'),
        array(Navigation::HEADER, 'Courses'),
        array(strtoupper($code), '#'),
        array(Navigation::HEADER, 'Subjects for ' . $code));

foreach($subjects as $subject){
    array_push($navArray, array(strtoupper($subject->code), URL::to_route('listtopics', array($code, $subject->code))));
}

echo Navigation::lists( Navigation::links($navArray));
