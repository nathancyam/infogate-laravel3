@layout('template.main')

@section('content')
    {{ Form::open(URL::to_action('account.update@update'), 'PUT') }}
        {{ Form::hidden('subject_id', $subject->id) }}

        <p>{{ Form::label('fname', 'Name of Topic') }}</p>
        <p>{{ Form::text('name', Input::old('name', $info->name)) }}</p>

        <p>{{ Form::label('content', 'Content of Topic') }}</p>
        <p>{{ Form::textarea('content', Input::old('content', $info->content)) }}</p>

        <p>{{ Form::submit('Update this topic') }}</p>
    {{ Form::close()}}
@endsection
