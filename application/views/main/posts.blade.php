@layout('template.main')

@section('content')
    @foreach($posts as $post)
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
    @endforeach
@endsection
