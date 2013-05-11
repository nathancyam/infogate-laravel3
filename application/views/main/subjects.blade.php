@layout('template.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div style="float: left;">
                <h2>Subjects for {{ $code->name }}</h2>
            </div>
            <div style="float: right;">
                {{ Button::primary_link(URL::base() . '/' . $code->code . '/subject/new', 'Create a new subject')}}
            </div>
        </div>
        @foreach($subjects as $subject)
            <div class="container-fluid">
                <h3>{{ $subject->code }}: {{ $subject->name }}</h3>
                <p>{{ $subject->description }}</p>
                <p>{{ Button::small_link(URL::to_route('listtopics', array($code->code, $subject->code)), 'List topics') }}
                {{ Button::small_link(URL::to_route('editsubject', array($code->code, $subject->code)), 'Edit Subject') }}</p>
                <hr />
            </div>
        @endforeach
    </div>
@endsection
