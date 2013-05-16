@layout('template.main')

@section('content')

<div class='container-fluid'>
	<h2>User List</h2>
	<div>
		@render('template.roledropdown')
	</div>
<?php
	echo Table::condensed_open();
	echo Table::headers('Forename', 'Surname', 'E-mail', 'Role');
	echo Table::body($table);
	echo Table::close();
?>
</div>
<script type="text/javascript">var BASE="<?php echo URL::base(); ?>"</script>

<?php
	echo HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js');
	echo HTML::script('js/loadusers.js');
?>

@endsection