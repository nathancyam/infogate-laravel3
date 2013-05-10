@layout('template.main')

@section('content')
    @if ( $isNew == true )
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
    @else
        {{ Form::open(URL::current(), 'PUT') }}
            {{ Form::hidden('coordinator_id',$user->id) }}
            {{ $errors->first('name', '<p class="error">:message</p>') }}
            <p>{{ Form::label('name', 'Course Name') }}</p>
            <p>{{ Form::text('name', Input::old('name', $name)) }}</p>
            {{ $errors->first('code', '<p class="error">:message</p>') }}
            <p>{{ Form::label('code', 'Course Code') }}</p>
            <p>{{ Form::text('code', Input::old('code', $code)) }}</p>
            <p>{{ Form::label('campus', 'Campus') }}</p>
            <p>
            <?php echo Form::select('campus', array(
                0 => 'Holmesglen',
                1 => 'Glen Waverley'), 0);
            ?>
            </p>
            <p>{{ Form::submit('Update Course') }}</p>
        {{ Form::close() }}
    @endif
@endsection
