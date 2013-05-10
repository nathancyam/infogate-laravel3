<p>{{ $code }}</p>
<ul class='navigation'>
    @foreach($subjects as $subject)
        <li>{{ HTML::link(URL::to_route('listtopics', array($code, $subject->code)), $subject->code) }}</li>
    @endforeach
</ul>
