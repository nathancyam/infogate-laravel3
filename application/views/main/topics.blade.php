@layout('template.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div style="float: left;">
            <h2>Topics for {{ $course->name }}: {{ $subject->name }}</h2>
        </div>
        @if (Auth::user()->role == 'admin')
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
            <p>{{ $topic->content }}</p>
            <p>
                {{ Button::small_link(URL::to_route('listposts', array($course->code, $subject->code, $topic->id)), 'See posts') }}
                @if (Auth::user()->role == 'admin')
                    {{ Button::small_link(URL::to_route('edittopic', array($course->code, $subject->code, $topic->id)), 'Edit topic') }}
                @endif
            </p>
            <hr />
        </div>
    @endforeach
</div>

@endsection
