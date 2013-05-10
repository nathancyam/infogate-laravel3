@layout('template.main')

@section('content')
    {{ HTML::link(URL::to_route('newtopic', array($course->code, $subject->code)), 'Create a new topic for ' . $subject->name) }}
    <p>List Topics for</p>
    {{ $course->name }}
    {{ $subject->name }}
    <p>
    @foreach($topics as $topic)
        <p>{{ HTML::link(URL::to_route('listposts', array($course->code, $subject->code, $topic->id)), 'See posts for ' . $topic->name) }}</p>
        <p>{{ HTML::link(URL::to_route('edittopic', array($course->code, $subject->code, $topic->id)), 'Edit topic ' . $topic->name) }}</p>
    @endforeach
    </p>
@endsection
