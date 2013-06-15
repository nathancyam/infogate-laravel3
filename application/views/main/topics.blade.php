@layout('template.main')

@section('content')

<?php
    $user = User::find(Auth::user()->id);
    $checkCoord = Event::fire('isCoord', array($user));
    $title = $course->name;
    $subtitle = $subject->name;
?>
<div class="container-fluid">
    <div class="row">
        @if ((Auth::user()->role == 'admin')||($checkCoord[0]))
        <div style="float: right;">
            {{ Button::primary_link(URL::to_route('newtopic', array($course->code, $subject->code)), 'New Topic') }}
        </div>
        @endif
    </div>
    @foreach($topics as $topic)
        <div class="container-fluid">
            <h3>
                {{ $topic->name }}
            </h3>
            <p>{{ $topic->formatted_content }}</p>
            <p>
                {{ Button::small_link(URL::to_route('listposts', array($course->code, $subject->code, $topic->id)), 'See posts') }}
                @if ((Auth::user()->role == 'admin')||($checkCoord[0]))
                    {{ Button::small_link(URL::to_route('edittopic', array($course->code, $subject->code, $topic->id)), 'Edit topic') }}
                    {{ Button::small_danger_link('#deleteTopic'.$topic->id, 'Delete', array('data-toggle'=>"modal")) }}
                @endif
            </p>
            <hr />
        </div>
        <div id="deleteTopic{{ $topic->id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Alert: Deleting Topic</h3>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this topic? You will be deleting related posts!</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            {{ Button::danger_link(URL::to_route('deletetopic', array($course->code, $subject->code, $topic->id)), 'Delete') }}
          </div>
        </div>
    @endforeach
</div>

@endsection
