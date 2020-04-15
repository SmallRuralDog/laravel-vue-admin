<?php
$router = app('router');

$router->group([
    'prefix' => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function ($router) {

});

//
$router->group([
    'prefix' => config('admin.route.api_prefix'),
    'middleware' => config('admin.route.middleware'),
], function ($router) {

});
