@layout('template.main')
@section('content')

<div class='container-fluid'>
    <h2>User Panel</h2>
    <h3>Enrolled Information</h3>
    <p>You are enrolled in {{ $courses->code }}: {{ $courses->name }}</p>
    <div>
        The subjects that you are enrolled in are:
        <ul>
            @foreach($subjects as $subject)
                <li>{{ strtoupper($subject->code) }}: {{ $subject->name }}</li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
