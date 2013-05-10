@layout('template.main')

@section('content')
	{{ HTML::link(URL::current() . '/new', 'Create a new post') }}
    @foreach($posts as $post)
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
    @endforeach
@endsection
