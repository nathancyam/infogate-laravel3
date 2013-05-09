@layout('template.main')

@section('content')
    @foreach($subjects as $subject)
        {{ $subject->name }}
    @endforeach
@endsection
