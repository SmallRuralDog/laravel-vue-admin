<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => config('admin.route.api_prefix'),
    'namespace'=>config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/home', 'HomeController@index')->name('admin.home');
});
