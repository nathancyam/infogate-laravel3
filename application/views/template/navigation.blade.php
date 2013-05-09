@layout('template.main')

@section('content')

<p>{{ $code }}</p>

@foreach($subjects as $subject)
    <p>{{ HTML::link($subject->name) }}</p>
@endforeach

@endsection
