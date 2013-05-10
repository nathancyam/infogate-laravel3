@layout('template.main')
@section('content')
    {{ Form::open(URL::current()) }}

        {{ Form::hidden('subject_id', $subject->id) }}

        <p>{{ Form::label('name', 'Name of Topic') }}</p>
        <p>{{ Form::text('name', Input::old('name')) }}</p>

        <p>{{ Form::label('content', 'Content of Topic') }}</p>
        <p>{{ Form::textarea('content', Input::old('content')) }}</p>

        <p>{{ Form::submit('Create new topic') }}</p>

    {{ Form::close() }}
@endsection
