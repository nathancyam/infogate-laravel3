@layout('template.main')

@section('content')
    @if ($isNew == true)
        {{ Form::open(URL::current()) }}

        {{ Form::hidden('course_id',$course->id) }}

        {{ $errors->first('code', '<p class="error">:message</p>') }}
        <p>{{ Form::label('code', 'Subject Code') }}</p>
        <p>{{ Form::text('code', Input::old('code')) }}</p>

        {{ $errors->first('name', '<p class="error">:message</p>') }}
        <p>{{ Form::label('name', 'Subject Name') }}</p>
        <p>{{ Form::text('name', Input::old('name')) }}</p>

        {{ $errors->first('description', '<p class="error">:message</p>') }}
        <p>{{ Form::label('description', 'Desciption') }}</p>
        <p>{{ Form::textarea('description', Input::old('description'), array('class'=>'field span11','rows'=>'10')) }}</p>

        <p>{{ Form::submit('Create Subject') }}</p>

        {{ Form::close() }}
    @else
        {{ Form::open(URL::current(), 'PUT') }}
        {{ Form::hidden('course_id',$course->id) }}

        {{ $errors->first('code', '<p class="error">:message</p>') }}
        <p>{{ Form::label('code', 'Subject Code') }}</p>
        <p>{{ Form::text('code', Input::old('code', $info->code)) }}</p>

        {{ $errors->first('name', '<p class="error">:message</p>') }}
        <p>{{ Form::label('name', 'Subject Name') }}</p>
        <p>{{ Form::text('name', Input::old('name', $info->name)) }}</p>

        {{ $errors->first('description', '<p class="error">:message</p>') }}
        <p>{{ Form::label('description', 'Desciption') }}</p>
        <p>{{ Form::textarea('description', Input::old('description', $info->description), array('class'=>'field span11', 'rows'=>'10')) }}</p>

        <p>{{ Form::submit('Update Subject') }}</p>
    @endif
@endsection
