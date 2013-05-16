{{ Form::open(URL::to_action('admin.users@update')) }}
{{ Form::inline_open() }}
{{ Form::text('fName', null, array('class'=>'input-small', 'placeholder'=>$user->fname)) }}
{{ Form::text('sName', null, array('class'=>'input-small', 'placeholder'=>$user->sname)) }}
