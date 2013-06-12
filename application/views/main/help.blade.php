@layout('template.main')

@section('content')

<h2>Help</h2>

<h3>What is Infogate?</h3>
<h4>How do I use this?</h4>
<p>Use the navigation bar to the left to browse different content on the page.</p>

<h4>What can I create?</h4>
<p>If you're a student, you can post items/content in the post section which can be found under Courses -> Subjects -> Topics -> Post</p>

<h4>I can't see my post!</h4>
<p>All posts created have to be curated by the course coordinator. Before they are accepted into their corresponding topics, they are saved as drafts</p>

<h4>What's my username?</h4>
<p>You can find your username besides the logout link to the top right.</p>

<h3>Security Concerns</h3>

<h4>I heard that plaintext password have been stored on databases that have been hacked and have stolen people's details. Do you do this?</h4>
<p>It's pretty, actually really bad practice to have plaintext passwords kept in a database. In this case, you need not worry. All password information in our server is encrypted using bcrypt, a certified encryption algorithm to ensure that this detail is secure.</p>

@endsection
