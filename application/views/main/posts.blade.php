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
        <div class='row-fluid'>
            <div id="userinfo" class="span2">
                <p><b>Title:</b> {{ $post->title }}</p>
                <p><b>Author:</b> {{ $post->user()->first()->username }}</p>
            </div>
            <div id="postbody" class="span8">
                <p>{{ $post->body }}</p>
            </div>
            <div id='userlinks'>
                <?php
                    $links = $post->working_links;
                    if($links){
                        echo "<hr />";
                        echo "<h4>Links</h4>";
                        for($i=0; $i<sizeof($links); $i++){
                            echo '<ul>';
                            echo '<li>'.$links[$i] . '</li>';
                            echo '</ul>';;
                        }
                    }
                ?>
            </div>
        </div>
        <div id="userbuttons">
            <p>
                <b>Actions:</b>
                @if(User::find(Auth::user()->id)->id == $post->author_id)
                    {{ Button::mini_link(URL::to_route('editpost', array($course, $subject, $topic, $post->id)), 'Edit this post')}}
                @endif
                @if(User::find(Auth::user()->id)->role !== 'student')
                    {{ Button::mini_primary_link(URL::to_route('approvepost', array($course, $subject, $topic, $post->id)), 'Approve')}}
                    {{ Button::mini_danger_link(URL::to_route('disapprovepost', array($course, $subject, $topic, $post->id)), 'Disapprove')}}
                @endif
            </p>
        </div>
    @endforeach
</div>
@endsection
