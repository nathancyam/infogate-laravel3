@layout('template.main')

@section('content')
    <h2>Topics for
    {{ $course->name }}
    {{ $subject->name }}
    </h2>
    {{ HTML::link(URL::to_route('newtopic', array($course->code, $subject->code)), 'Create a new topic for ' . $subject->name) }}
    @foreach($topics as $topic)
        <h3>
            {{ $topic->name }}
        </h3>
        <p>{{ $topic->content }}</p>
        <p>{{ HTML::link(URL::to_route('listposts', array($course->code, $subject->code, $topic->id)), 'See posts for ' . $topic->name) }}</p>
        <p>{{ HTML::link(URL::to_route('edittopic', array($course->code, $subject->code, $topic->id)), 'Edit topic ' . $topic->name) }}</p>
    @endforeach
    </p>
@endsection
