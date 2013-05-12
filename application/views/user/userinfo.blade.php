@layout('template.main')
@section('content')

<div class='container-fluid'>
    <h2>User Panel</h2>
    <h3>User Information</h3>
    <p>Name: {{ $user->fname }} {{ $user->sname }}</p>
    <p>Email: {{ $user->email }}</p>
</div>

@endsection
