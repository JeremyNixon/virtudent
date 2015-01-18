<?php
error_reporting(E_ALL);       # Report Errors, Warnings, and Notices
ini_set('display_errors', 1); # Display errors on page (instead of a log file)
date_default_timezone_set ('america/new_york');
?>

<!doctype html>
<html>
  <head>
    <title></title>

  	@yield('title')

  	@section('head')
  		<link rel=stylesheet type="text/css" href="{{ URL::asset('/virtudent.css') }}">
  		<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
      <link rel=stylesheet type="text/css" href="{{ URL::asset('/cs109-style.css') }}">
      <link href='http://fonts.googleapis.com/css?family=Muli:300' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Yellowtail' rel='stylesheet' type='text/css'>
    @show
  </head>


    <div id='header'>
      <ul id="navlist">
        <li ><a class='' href="/"></a><li>
        <li> <img class='logo' src="{{URL::asset('logo.gif')}}"></li>
    @if(Auth::check())
      <li><a href="/logout">Logout</a></li>
      <li><a href="/edit">Edit Profile</a></li>
    @else
    <li><a href="/signup">Sign Up</a>|<a href="/login">Login</a></li>
    @endif

    @if(Auth::check())
        <li>Hello {{ Auth::user()->name; }}!</li>
    @endif 
      </ul>
    </div><br><br>
  <body>
  <div id="container">
  @if(Session::get('flash_message'))
      <div class='flash-message'>{{ Session::get('flash_message') }}</div>
  @endif
  @yield('body')

  </div>
  </body>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-58445831-1', 'auto');
    ga('send', 'pageview');

  </script>
</html>
