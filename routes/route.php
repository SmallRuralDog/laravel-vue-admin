<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $authController = config('admin.auth.controller', AuthController::class);
    $router->get('auth/login', $authController . '@getLogin')->name('admin.login');
    $router->post('auth/login', $authController . '@postLogin')->name('admin.post.login');
    $router->get('auth/logout', $authController . '@getLogout')->name('admin.logout');
    $router->get('auth/setting', $authController . '@getSetting')->name('admin.setting');
    $router->put('auth/setting', $authController . '@putSetting');

    $router->get('/', \SmallRuralDog\Admin\Controllers\RootController::class . "@index")->name('admin.root');
});
Route::group([
    'prefix' => config('admin.route.api_prefix'),
    'middleware' => config('admin.route.middleware'),
    'namespace' => '\SmallRuralDog\Admin\Controllers'
], function (Router $router) {
    $router->resource('auth/users', 'UserController')->names('admin.auth.users');
    $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
    $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
    $router->resource('auth/menu', 'MenuController')->names('admin.auth.menu');
    $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');
    $router->post('_handle_form_', 'HandleController@handleForm')->name('admin.handle-form');
    $router->post('_handle_action_', 'HandleController@handleAction')->name('admin.handle-action');
});
