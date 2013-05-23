@layout('template.main')

@section('content')

<div class='container-fluid'>
    <h2>User Panel</h2>
    <p>This is the user panel page. From here, you can see your current enrollments, courses, and subjects.</p>
    <p>You can also edit your user details if needed.</p>
    <ul>
        <li>{{ HTML::link_to_action('account@courses', 'Courses Enrolled') }}</li>
        <li>{{ HTML::link_to_action('account@info', 'User Information') }}</li>
    </ul>
</div>

@endsection
