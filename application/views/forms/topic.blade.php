@layout('template.main')
@section('content')
    @if ($isNew == true)
        {{ Form::open(URL::current()) }}

            {{ Form::hidden('subject_id', $subject->id) }}

            <p>{{ Form::label('name', 'Name of Topic') }}</p>
            <p>{{ Form::text('name', Input::old('name')) }}</p>

            <p>{{ Form::label('content', 'Content of Topic') }}</p>
            <p>{{ Form::textarea('content', Input::old('content'), array('class'=>'field span11','rows'=>'10')) }}</p>

            <p>{{ Form::submit('Create new topic') }}</p>

        {{ Form::close() }}
    @else
        {{ Form::open(URL::current(), 'PUT') }}
            {{ Form::hidden('subject_id', $subject->id) }}

            <p>{{ Form::label('name', 'Name of Topic') }}</p>
            <p>{{ Form::text('name', Input::old('name', $info->name)) }}</p>

            <p>{{ Form::label('content', 'Content of Topic') }}</p>
            <p>{{ Form::textarea('content', Input::old('content', $info->form_content), array('class'=>'field span11','rows'=>'10')) }}</p>

            <p>{{ Form::submit('Update this topic') }}</p>
        {{ Form::close()}}
    @endif
@endsection
