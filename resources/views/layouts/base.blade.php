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
<div id="vue-admin">@yield('content')</div>
<script>
    Admin = {};
    Admin.token = "{{csrf_token()}}";
    window.config = {
        'apiRoot': "{{config('admin.route.api_prefix')}}"
    }
</script>
@yield('js')
<script src="{{ mix('manifest.js', 'vendor/laravel-vue-admin') }}"></script>
<script src="{{ mix('vendor.js', 'vendor/laravel-vue-admin') }}"></script>
<script src="{{ mix('app.js', 'vendor/laravel-vue-admin') }}"></script>

<script>
    window.VueAdmin = new CreateVueAdmin(config)
</script>

<script>
    VueAdmin.liftOff()
</script>
</body>
</html>
