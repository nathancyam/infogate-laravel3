<?php
echo DropdownButton::small('Choose Role',
  Navigation::links(
	array(
	    array('Admin', URL::to_action('admin.users@role', array('admin'))),
	    array('Coorindators', URL::to_action('admin.users@role',  array('coordinator'))),
	    array('Teachers', URL::to_action('admin.users@role',  array('teacher'))),
	    array('Students', URL::to_action('admin.users@role',  array('student'))),
	    )
	)
);
?>
