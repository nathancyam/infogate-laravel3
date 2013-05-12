@layout('template.main')
@section('content')

<div class='container-fluid'>
    <div class='row'>
        <div style="float: left;">
            <h1>Courses</h1>
        </div>
        @if (Auth::user()->role == 'admin')
            <div style='float: right;'>
                {{ HTML::link_to_route('newcourse','Add a new course') }}
            </div>
        @endif
    </div>
    @foreach($courses as $acourse)
        <div style="container-fluid">
            <h3>{{ $acourse->code }}: {{ $acourse->name }}</h3>
            <p>{{ HTML::link(URL::to_route('listsubjects', array($acourse->code)), 'See subjects for ' . $acourse->name) }}</p>
            @if (Auth::user()->role == 'admin')
                <p>{{ HTML::link(URL::to_route('editcourse', array($acourse->code)), 'Update this course: ' . $acourse->name) }}</p>
            @endif
        </div>
    @endforeach
</div>

@endsection
