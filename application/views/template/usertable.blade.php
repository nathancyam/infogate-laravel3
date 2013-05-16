<?php
	echo Table::condensed_open();
	echo Table::headers('Forename', 'Surname', 'E-mail', 'Role', 'Options');
	echo Table::body($table)->ignore('id');
	echo Table::close();
?>
