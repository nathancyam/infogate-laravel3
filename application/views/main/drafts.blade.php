@layout('template.main')

@section('content')
<?php
    $title = strtoupper($subject);
    $subtitle = Topic::find($topic)->name;
?>
<div class='container-fluid'>
    <div class='row'>
        <div class="pull-right">
            {{ Button::primary_link(URL::to_route('posts', array($course, $subject, $topic)), 'New Draft') }}
        </div>
    </div>
    <div>
        <?php
            echo Navigation::tabs(
              Navigation::links(
                array(
                  array('Posts', URL::to_route('listposts', array($course, $subject, $topic))),
                  array('Drafts', URL::current(), true))
              )
            );
        ?>
    </div>
    @foreach($posts as $post)
        <div class="row-fluid posts shadow">
            <div class='row-fluid'>
                <div id="userinfo" class="span2 post-author pull-left">
                    <p><b>Author:</b> {{ $post->user()->first()->username }}</p>
                </div>
                <div id="postbody" class="span10 post-body pull-right">
                    <p><b>Title:</b> {{ $post->title }}</p>
                    <p>{{ $post->body }}</p>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2 post-author">
                    <p><b>Links:</b></p>
                </div>
                <div id="linkbody" class="span10 post-links">
                    @if ($post->working_links)
                        @for($i=0; $i<sizeof($post->working_links); $i++)
                            <ul>
                            <li>{{ $post->working_links[$i] }}</li>
                            </ul>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <div id="userbuttons">
            <p>
                <b>Actions:</b>
                @if(User::find(Auth::user()->id)->id == $post->author_id)
                    {{ Button::mini_link(URL::to_route('editpost', array($course, $subject, $topic, $post->id)), 'Edit this post')}}
                @endif
                @if(User::find(Auth::user()->id)->role !== 'student')
                    {{ Button::mini_primary_normal('Approve', array('id'=>'btn_Approve', 'data-link'=>URL::to_route('approvepost', array($course, $subject, $topic, $post->id)))) }}
                    {{ Button::mini_danger_link('#deletePost'.$post->id, 'Delete', array('data-toggle'=>"modal")) }}
                @endif
            </p>
        </div>
        <div id="deletePost{{ $post->id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Alert: Deleting Post</h3>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this post?</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            {{ Button::danger_link(URL::to_route('deletepost', array($course, $subject, $topic, $post->id)), 'Delete') }}
          </div>
        </div>
    @endforeach
</div>


{{ HTML::style('css/posts.css') }}
{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('js/posts.js') }}
@endsection
