@layout('template.main')

@section('content')
	{{ HTML::link(URL::current() . '/new', 'Create a new post') }}
    @foreach($posts as $post)
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
        <p>{{ HTML::link(URL::to_route('editpost', array($course, $subject, $topic, $post->id)))}}</p>
    @endforeach
@endsection
