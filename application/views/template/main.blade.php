<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Wordpush</title>
    {{ Asset::container('bootstrapper')->styles() }}
    {{ Asset::container('bootstrapper')->scripts() }}
</head>
<body>
    <div class="container-fluid">
        <div class="header">
            <hr />
            <h1>Infogate</h1>
            <h2>Eduction Portal</h2>
        </div>
        <div class='navbar navbar-inverse'>
            <div class='navbar-inner nav-collapse' style="height: auto;">
                <ul class="nav">
                    <li class="active">
                        {{ HTML::link(URL::base(), 'Home') }}
                    </li>
                </ul>
                <p class="navbar-text pull-right">
                    @if ( Auth::guest() )
                        {{ HTML::link('login', 'Login') }}
                    @else
                        Logged in as
                        {{ Auth::user()->username }}
                        &nbsp
                        {{ HTML::link('logout', 'Logout?') }}
                    @endif
                </p>
            </div>
        </div>
        <nav>
        <div id='content' class='row-fluid'>
            <nav class='span2 sidebar'>
                @if ( Auth::guest() )
                @else
                    @render('template.navigation')
                @endif
            </nav>
            <div class="span10 main">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
