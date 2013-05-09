@layout('template.main')

@section('content')
    {{ Form::open('course/new') }}

    {{ Form::hidden('coordinator_id',$user->id) }}

    {{ $errors->first('name', '<p class="error">:message</p>') }}
    <p>{{ Form::label('name', 'Course Name') }}</p>
    <p>{{ Form::text('name', Input::old('title')) }}</p>

    {{ $errors->first('code', '<p class="error">:message</p>') }}
    <p>{{ Form::label('code', 'Course Code') }}</p>
    <p>{{ Form::text('code', Input::old('code')) }}</p>

    <p>{{ Form::label('campus', 'Campus') }}</p>
    <p>
    <?php echo Form::select('campus', array(
        0 => 'Holmesglen',
        1 => 'Glen Waverley'), 0);
    ?>
    </p>

    <p>{{ Form::submit('Create Course') }}</p>

    {{ Form::close() }}
@endsection
