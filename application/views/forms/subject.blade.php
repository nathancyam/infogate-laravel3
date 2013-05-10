@layout('template.main')

@section('content')
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
    <p>{{ Form::textarea('description', Input::old('description')) }}</p>

    <p>{{ Form::submit('Create Subject') }}</p>

    {{ Form::close() }}
@endsection
