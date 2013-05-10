@layout('template.main')

@section('content')
	{{ HTML::link(URL::base() . '/' . $code . '/subject/new', 'Create a new subject')}}
    @foreach($subjects as $subject)
        {{ HTML::link(URL::to_route('listtopics', array($code, $subject->code)), 'Topics for ' . $subject->name) }}
    @endforeach
@endsection
