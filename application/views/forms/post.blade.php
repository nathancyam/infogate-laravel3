@layout('template.main')

@section('content')
    <p>Create a post for {{ $topic->name }} </p>
    @if ($isNew == true)
        {{ Form::open(URL::current()) }}

            {{ Form::hidden('author_id',$user->id) }}
            {{ Form::hidden('topic_id',$topic->id) }}

            <p>{{ Form::label('title', 'Title of Post') }}</p>
            <p>{{ Form::text('title', Input::old('title')) }}</p>

            <p>{{ Form::label('body', 'Content of Topic') }}</p>
            <p>{{ Form::textarea('body', Input::old('body')) }}</p>

            <p>{{ Form::submit('Create new post') }}</p>

        {{ Form::close() }}
    @else
        {{ Form::open(URL::current(), 'PUT') }}

            {{ Form::hidden('author_id',$user->id) }}
            {{ Form::hidden('topic_id',$topic->id) }}

            <p>{{ Form::label('title', 'Title of Post') }}</p>
            <p>{{ Form::text('title', Input::old('title', $post->title)) }}</p>

            <p>{{ Form::label('body', 'Content of Topic') }}</p>
            <p>{{ Form::textarea('body', Input::old('body', $post->body)) }}</p>

            <p>{{ Form::submit('Update this post') }}</p>

        {{ Form::close() }}
    @endif
@endsection
