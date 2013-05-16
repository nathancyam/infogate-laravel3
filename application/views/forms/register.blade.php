@layout('template.main')

@section('content')
    @if($isNew == true)
        {{ Form::open(URL::to_action('register@createuser')) }}

        {{ $errors->first('fName', '<p class="error">:message</p>') }}
        <p>{{ Form::label('fName', 'First Name:') }}</p>
        <p>{{ Form::text('fName', Input::old('fName')) }}</p>

        {{ $errors->first('sName', '<p class="error">:message</p>') }}
        <p>{{ Form::label('sName', 'Surname') }}</p>
        <p>{{ Form::text('sName', Input::old('sName')) }}</p>


        {{ $errors->first('password', '<p class="error">:message</p>') }}

        <p>{{ Form::label('password', 'Password') }}</p>
        <p>{{ Form::password('password') }}</p>

        <p>{{ Form::label('passwordcheck', 'Re-type Password') }}</p>
        <p>{{ Form::password('passwordcheck') }}</p>

        {{ $errors->first('email', '<p class="error">:message</p>') }}
        <p>{{ Form::label('email', 'E-mail') }}</p>
        <p>{{ Form::email('email') }}</p>

        {{ $errors->first('enrollment', '<p class="error">:message</p>') }}
        <p>{{ Form::label('enrollment', 'Course Enrollment') }}</p>
        {{ Form::select('enrollment', array($courses)) }}

        <p>{{ Form::label('role', 'Role') }}</p>
        {{ Form::select('role', array('student'=>'Student')) }}

        <p>{{ Form::submit('Sign Up') }}</p>

        {{ Form::close() }}
    @else
        {{ Form::open(URL::to_action('account@postupdate')) }}

        {{ $errors->first('fName', '<p class="error">:message</p>') }}
        <p>{{ Form::label('fName', 'First Name:') }}</p>
        <p>{{ Form::text('fName', Input::old('fName', $user->fname)) }}</p>

        {{ $errors->first('sName', '<p class="error">:message</p>') }}
        <p>{{ Form::label('sName', 'Surname') }}</p>
        <p>{{ Form::text('sName', Input::old('sName', $user->sname)) }}</p>

        {{ $errors->first('email', '<p class="error">:message</p>') }}
        <p>{{ Form::label('email', 'E-mail') }}</p>
        <p>{{ Form::email('email', $user->email) }}</p>

        <p>{{ Form::submit('Save Changes') }}</p>

        {{ Form::close() }}
    @endif
@endsection
