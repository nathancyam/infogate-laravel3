<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Infogate</title>
    {{ Asset::container('bootstrapper')->styles() }}
    {{ Asset::container('bootstrapper')->scripts() }}
</head>
<body>
    <div class="container-fluid">
        <div class="hero-unit">
            <h1>Infogate</h1>
            <h2>Education Portal</h2>
        </div>
        <div class='navbar navbar-inverse'>
            <div class='navbar-inner nav-collapse' style="height: auto;">
                <ul class="nav">
                    <li class="active">
                        {{ HTML::link(URL::base(), 'Home') }}
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="navbar-text pull-right">
                        @if ( Auth::guest() )
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In<strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                    @render('main.login')
                                </div>
                            </li>
                        @else
                            <li class="navbar-text">Welcome back, {{ User::find(Auth::user()->id)->username }}</li>
                            <li>
                                {{ HTML::link('logout', 'Logout?') }}
                            </li>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div id='content' class='row-fluid'>
            <nav class='span2 sidebar'>
                <div data-spy="affix">
                    @if ( Auth::guest() )
                    @else
                        @render('template.navigation')
                    @endif
                <div>
            </nav>
            <div class="span10 main">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
