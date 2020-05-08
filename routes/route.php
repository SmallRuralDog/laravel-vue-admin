<?php

use Illuminate\Routing\Router;
use SmallRuralDog\Admin\Controllers\RootController;

Route::group([
    'domain'=>config('admin.route.domain'),
    'prefix' => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $authController = config('admin.auth.controller', AuthController::class);
    $router->get('auth/login', $authController . '@getLogin')->name('admin.login');
    $router->post('auth/login', $authController . '@postLogin')->name('admin.post.login');
    $router->get('auth/logout', $authController . '@getLogout')->name('admin.logout');
    $router->get('auth/setting', $authController . '@getSetting')->name('admin.setting');
    $router->put('auth/setting', $authController . '@putSetting');
    $router->get('/', RootController::class . "@index")->name('admin.root');


});
Route::group([
    'domain'=>config('admin.route.domain'),
    'prefix' => config('admin.route.api_prefix'),
    'namespace' => '\SmallRuralDog\Admin\Controllers'
], function (Router $router) {

    $router->get('scripts/{script}', 'ScriptController@show')->name('admin.scripts');
    $router->get('styles/{style}', 'StyleController@show')->name('admin.styles');

    $router->group(['middleware' => config('admin.route.middleware')], function (Router $router) {
        $router->resource('auth/users', 'UserController')->names('admin.auth.users');
        $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
        $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
        $router->resource('auth/menu', 'MenuController')->names('admin.auth.menu');
        $router->post('auth/menu-order', 'MenuController@menuOrder')->name('admin.auth.menu.order');
        $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');
        $router->post('_handle_upload_image_', 'HandleController@uploadImage')->name('admin.handle-upload-image');
        $router->post('_handle_upload_file_', 'HandleController@uploadFile')->name('admin.handle-upload-file');
        $router->post('_handle_form_', 'HandleController@handleForm')->name('admin.handle-form');
        $router->post('_handle_action_', 'HandleController@handleAction')->name('admin.handle-action');
    });
});
