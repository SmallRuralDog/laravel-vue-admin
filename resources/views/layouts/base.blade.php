<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Admin::title() }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @yield('head-js')
</head>
<body>
<div id="app">@yield('content')</div>
@yield('js')
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
