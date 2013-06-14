<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Infogate</title>
    {{ Asset::container('bootstrapper')->styles() }}
    {{ Asset::container('bootstrapper')->scripts() }}
</head>
<body>
    {{ HTML::style('css/header.css') }}
    <div class='navbar navbar-inverse navbar-fixed-top'>
        <div class='navbar-inner nav-collapse' style="height: auto;">
            <div class='container'>
                {{ HTML::link(URL::base(), 'Infogate', array("class"=>"brand")) }}
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
    </div>
    <header class="hero-unit hero-picture">
        <div class="container">
            <?php
            if(isset($title)){
                echo '<h1>' . $title . '</h1>';
                echo '<h2>' . $subtitle . '</h2>';
            } else {
                echo '<h1>Infogate</h1>';
                echo '<h2>Education Portal</h2>';
            }
           ?>
        </div>
    </header>
    <div id='content' class='container'>
        <div class='row'>
            <div class='span2 sidebar'>
                @if ( Auth::guest() )
                @else
                    @render('template.navigation')
                @endif
            </div>
            <div class="span10 main">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
