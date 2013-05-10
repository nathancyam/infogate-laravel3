@layout('template.main')

@section('content')
	{{ HTML::link(URL::base() . '/' . $code . '/subject/new', 'Create a new subject')}}
    @foreach($subjects as $subject)
        {{ $subject->name }}
    @endforeach
@endsection
