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
    <?php
        echo Navigation::tabs(
          Navigation::links(
            array(
              array('Posts', URL::current(), true),
              array('Drafts', URL::current() . "/drafts"))
          )
        );
    ?>
    @foreach($posts as $post)
        <div class="row-fluid posts shadow">
            <div class='row-fluid'>
                <div id="userinfo" class="span2 post-author">
                    <p><b>Title:</b> {{ $post->title }}</p>
                    <p><b>Author:</b> {{ $post->user()->first()->username }}</p>
                </div>
                <div id="postbody" class="span8 post-body">
                    <p>{{ $post->body }}</p>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2 post-author">
                    <p><b>Links:</b></p>
                </div>
                <div id="linkbody" class="span8 post-links">
                    @if ($post->working_links)
                        @for($i=0; $i<sizeof($post->working_links); $i++)
                            <ul>
                            <li>{{ $post->working_links[$i] }}</li>
                            </ul>
                        @endfor
                    @endif
                </div>
            </div>
            <div id="userbuttons" class="post-buttons">
                <p>
                    <b>Actions:</b>
                    @if(User::find(Auth::user()->id)->id == $post->author_id)
                        {{ Button::mini_link(URL::to_route('editpost', array($course, $subject, $topic, $post->id)), 'Edit this post')}}
                    @endif
                </p>
            </div>
        </div>
    @endforeach
</div>
{{ HTML::style('css/posts.css') }}
@endsection
