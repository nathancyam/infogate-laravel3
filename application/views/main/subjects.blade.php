@layout('template.main')

@section('content')
<?php
    $user = User::find(Auth::user()->id);
    $checkCoord = Event::fire('isCoord', array($user));
    $title = $code->name;
    $subtitle = "Subjects";
?>
<div class="container-fluid">
    <div class="row">
        @if ((Auth::user()->role == 'admin')||($checkCoord[0]))
            <div style="float: right;">
                {{ Button::primary_link(URL::base() . '/' . $code->code . '/subject/new', 'New Subject')}}
            </div>
        @endif
    </div>
    @foreach($subjects as $subject)
        <div class="row-fluid">
            <h3>{{ strtoupper($subject->code) }}: {{ $subject->name }}</h3>
            <p>{{ $subject->description }}</p>
            <p>
                {{ Button::small_link(URL::to_route('listtopics', array($code->code, $subject->code)), 'List topics') }}
                @if ((Auth::user()->role == 'admin')||($checkCoord[0]))
                    {{ Button::small_link(URL::to_route('editsubject', array($code->code, $subject->code)), 'Edit Subject') }}
                    {{ Button::danger_link('#deleteSubject'.$subject->id, 'Delete', array('data-toggle'=>"modal")) }}
                @endif
            </p>
            <hr />
        </div>
        <div id="deleteSubject{{ $subject->id }}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Alert: Deleting Subject</h3>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this subject? You will be deleting related topics and posts!</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            {{ Button::danger_link(URL::to_route('deletesubject', array($code->code, $subject->id)), 'Delete') }}
          </div>
        </div>
    @endforeach
</div>

{{ HTML::style('css/posts.css') }}

@endsection
