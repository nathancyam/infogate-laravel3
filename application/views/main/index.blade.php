@layout('template.main')

@section('content')
    <p>This view has been auto-generated to accompany the Main_Controller's action_index()</p>
    @foreach($courses as $acourse)
        <div>
            <p>{{ $acourse->name }}</p>
        </div>
    @endforeach
    {{  HTML::link_to_route('newcourse','Add a new course') }}
    {{  HTML::link(URL::to_route('newtopic',array('test1010','1')),'Add a new topic') }}
    {{  HTML::link(URL::to_route('listtopics',array('test1010','1')),'List all topics for test1010 subject 1') }}
@endsection
