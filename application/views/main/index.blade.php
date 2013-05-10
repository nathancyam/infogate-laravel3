@layout('template.main')

@section('content')
    {{ HTML::link_to_route('listcourses', 'See a list of courses') }}
@endsection
