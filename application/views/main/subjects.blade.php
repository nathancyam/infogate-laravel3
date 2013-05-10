@layout('template.main')

@section('content')
    <h2>Subjects for
    {{ $code->name }}</h2>
    {{ HTML::link(URL::base() . '/' . $code->name . '/subject/new', 'Create a new subject')}}
    @foreach($subjects as $subject)
        <p>{{ HTML::link(URL::to_route('listtopics', array($code->code, $subject->code)), 'Topics for ' . $subject->name) }}</p>
        <p>{{ HTML::link(URL::to_route('editsubject', array($code->code, $subject->code)), 'Edit Subject ' . $subject->name) }}</p>
    @endforeach
@endsection
