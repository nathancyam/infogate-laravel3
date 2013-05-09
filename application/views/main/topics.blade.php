@layout('template.main')

@section('content')
    <p>List Topics for</p>
    {{ $course->name }}
    {{ $subject->name }}
    <p>
    @foreach($topics as $topic)
        {{ $topic->name }}
    @endforeach
    </p>
@endsection
