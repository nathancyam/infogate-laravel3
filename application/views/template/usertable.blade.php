<?php
	echo Table::condensed_open();
	echo Table::headers('Forename', 'Surname', 'E-mail', 'Role');
	echo Table::body($table)->ignore('id');
	echo Table::close();
?>
