<p>{{ $code }}</p>
<ul class='navigation'>
    @foreach($subjects as $subject)
        <li>{{ HTML::link($subject->name) }}</li>
    @endforeach
</ul>
