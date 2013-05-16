@layout('template.main')

@section('content')
<div class='container-fluid'>
    <div class='row'>
        <div class='pull-left'>
            <h2>Posts</h2>
        </div>
        <div class="pull-right">
            {{ Button::primary_link(URL::current() . '/new', 'New Post') }}
        </div>
    </div>
    @foreach($posts as $post)
        <div>
            <p>Title: {{ $post->title }}</p>
            <p>Author: {{ $post->user()->first()->username }}</p>
            <p>{{ $post->body }}</p>
            <?php
                $links = explode("\n", $post->links);
                foreach($links as $link){
                    $formattedlink = "<a href=http://" . $link . ">" . $link . "</a>";
                    echo "<p id='link'>";
                    echo HTML::decode($formattedlink);
                    echo "</p>";
                }
            ?>
            <p>
                {{ Button::small_link(URL::to_route('editpost', array($course, $subject, $topic, $post->id)), 'Edit this post')}}
                @if(User::find(Auth::user()->id)->role !== 'student')
                {{ Button::small_primary_link(URL::to_route('approvepost', array($course, $subject, $topic, $post->id)), 'Approve')}}
                {{ Button::small_danger_link(URL::to_route('disapprovepost', array($course, $subject, $topic, $post->id)), 'Disapprove')}}
                @endif
            </p>
        <div>
    @endforeach
</div>
@endsection
