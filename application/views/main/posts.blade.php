@layout('template.main')

@section('content')
<div class='container-fluid'>
    <div class='row'>
        <div class='pull-left'>
            <h2>Posts</h2>
        </div>
        <div class="pull-right">
            {{ Button::primary_link(URL::current() . '/new', 'Create a new post') }}
        </div>
    </div>
    @foreach($posts as $post)
        <div>
            <p>Title: {{ $post->title }}</p>
            <p>Author: {{ $post->user()->first()->username }}</p>
            <p>{{ $post->body }}</p>
            <p>{{ Button::link(URL::to_route('editpost', array($course, $subject, $topic, $post->id)), 'Edit this post')}}</p>
        <div>
    @endforeach
</div>
@endsection
