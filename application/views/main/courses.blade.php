@layout('template.main')
@section('content')
    <h1>Courses</h1>
    {{ HTML::link_to_route('newcourse','Add a new course') }}
    @foreach($courses as $acourse)
        <div>
            <p>{{ $acourse->name }}</p>
            <p>{{ HTML::link(URL::to_route('listsubjects', array($acourse->code)), 'See subjects for ' . $acourse->name) }}</p>
            <p>{{ HTML::link(URL::to_route('editcourse', array($acourse->code)), 'Update this course: ' . $acourse->name) }}</p>
        </div>
    @endforeach
@endsection
