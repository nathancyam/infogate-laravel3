@layout('template.main')

@section('content')
    {{ HTML::link(URL::base() . '/' . $code . '/subject/new', 'Create a new subject')}}
    @foreach($subjects as $subject)
        <p>{{ HTML::link(URL::to_route('listtopics', array($code, $subject->code)), 'Topics for ' . $subject->name) }}</p>
        <p>{{ HTML::link(URL::to_route('editsubject', array($code, $subject->code)), 'Edit Subject ' . $subject->name) }}</p>
    @endforeach
@endsection
