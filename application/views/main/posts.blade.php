@layout('template.main')

@section('content')
<div class='container-fluid'>
    <div class='row'>
        <div class='pull-left'>
            <h2>
                Posts for {{ strtoupper($subject) }} - {{ Topic::find($topic)->name }}
            </h2>
        </div>
        <div class="pull-right">
            {{ Button::primary_link(URL::current() . '/new', 'New Post') }}
        </div>
    </div>
    @foreach($posts as $post)
        <div>
            <p><b>Title:</b> {{ $post->title }}</p>
            <p><b>Author:</b> {{ $post->user()->first()->username }}</p>
            <p>{{ $post->body }}</p>
            <hr />
            <h4>Links</h4>
            <?php
                $links = $post->working_links;
                for($i=0; $i<sizeof($links); $i++){
                    echo '<ul>';
                    echo '<li>'.$links[$i] . '</li>';
                    echo '</ul>';;
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
