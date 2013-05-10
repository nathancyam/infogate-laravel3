@layout('template.main')

@section('content')
	{{ HTML::link(URL::to_route('newtopic', array($course->code, $subject->code)), 'Create a new topic for ' . $subject->name) }}
    <p>List Topics for</p>
    {{ $course->name }}
    {{ $subject->name }}
    <p>
    @foreach($topics as $topic)
    	{{ HTML::link(URL::to_route('listposts', array($course->code, $subject->code, $topic->id)), 'See posts for ' . $topic->name) }}
    @endforeach
    </p>
@endsection
