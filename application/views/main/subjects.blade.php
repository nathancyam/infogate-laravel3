@layout('template.main')

@section('content')
<?php
    $user = User::find(Auth::user()->id);
    $checkCoord = Event::fire('isCoord', array($user));
?>
<div class="container-fluid">
    <div class="row">
        <div style="float: left;">
            <h2>Subjects for {{ $code->name }}</h2>
        </div>
        @if ((Auth::user()->role == 'admin')||($checkCoord[0]))
            <div style="float: right;">
                {{ Button::primary_link(URL::base() . '/' . $code->code . '/subject/new', 'Create a new subject')}}
            </div>
        @endif
    </div>
    @foreach($subjects as $subject)
        <div class="container-fluid">
            <h3>{{ $subject->code }}: {{ $subject->name }}</h3>
            <p>{{ $subject->description }}</p>
            <p>{{ Button::small_link(URL::to_route('listtopics', array($code->code, $subject->code)), 'List topics') }}
            @if ((Auth::user()->role == 'admin')||($checkCoord[0]))
                {{ Button::small_link(URL::to_route('editsubject', array($code->code, $subject->code)), 'Edit Subject') }}</p>
            @endif
            <hr />
        </div>
    @endforeach
</div>

@endsection
