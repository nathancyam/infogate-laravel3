@layout('template.main')

@section('content')

<div class='container-fluid'>
    <h2>User List</h2>
    <div>
<?php
echo Form::select('role', array('Admin', 'Coordinators','Teachers', 'Students'),'Admin',array("id"=>"userrole"));
?>
    </div>
    <div id="table">
<?php
echo Table::condensed_open();
echo Table::headers('Forename', 'Surname', 'E-mail', 'Role', 'Options');
echo Table::body($table);
echo Table::close();
?>
    </div>
</div>
<script type="text/javascript">var BASE="<?php echo URL::current(); ?>"</script>

<?php
echo HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js');
echo HTML::script('js/loadusers.js');
?>

@endsection
