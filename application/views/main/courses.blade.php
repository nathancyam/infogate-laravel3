@layout('template.main')
@section('content')
    {{ HTML::link_to_route('newcourse','Add a new course') }}
    @foreach($courses as $acourse)
        <div>
            <p>{{ $acourse->name }}</p>
            {{ HTML::link(URL::to_route('listsubjects', array($acourse->code)), 'See subjects for ' . $acourse->name) }}
        </div>
    @endforeach
@endsection
