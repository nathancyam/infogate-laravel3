@layout('template.main')

@section('content')
    {{ Form::hidden('author_id',$user->id) }}
    {{ Form::hidden('topic_id',$topic->id) }}

    <h4>Create a post for {{ $topic->name }}</h4>
    @if ($isNew == true)
        {{ Form::open(URL::current()) }}
            <p><b>{{ Form::label('title', 'Title of Post') }}</b></p>
            <p>{{ Form::text('title', Input::old('title')) }}</p>

            <p><b>{{ Form::label('body', 'Content of Topic') }}</b></p>
            <p>{{ Form::textarea('body', Input::old('body'), array('class'=>'field span11','rows'=>'10')) }}</p>

            <p>Enter a link on each new line</p>
            <p><b>{{ Form::label('links', 'Links') }}</b></p>
            <p>{{ Form::textarea('links', Input::old('links'), array('class'=>'field span11','rows'=>'3')) }}</p>

            <p>{{ Form::submit('Create new post') }}</p>

        {{ Form::close() }}
    @else
        {{ Form::open(URL::current(), 'PUT') }}

            <p><b>{{ Form::label('title', 'Title of Post') }}</b></p>
            <p>{{ Form::text('title', Input::old('title', $post->title)) }}</p>

            <p><b>{{ Form::label('body', 'Content of Topic') }}</b></p>
            <p>{{ Form::textarea('body', Input::old('body', $post->body)) }}</p>

            <p>Enter a link on each new line</p>
            <p><b>{{ Form::label('links', 'Links') }}</b></p>
            <p>{{ Form::textarea('links', Input::old('body', $post->links)) }}</p>

            <p>{{ Form::submit('Update this post') }}</p>

        {{ Form::close() }}
    @endif
@endsection
