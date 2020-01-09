<?php

namespace SmallRuralDog\Admin;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SmallRuralDog\Admin\Auth\Database\Menu;
use SmallRuralDog\Admin\Controllers\AuthController;

class Admin
{

    protected $menu = [];
    public static $metaTitle;

    public static function setTitle($title)
    {
        self::$metaTitle = $title;
    }

    /**
     * Get admin title.
     *
     * @return string
     */
    public function title()
    {
        return self::$metaTitle ? self::$metaTitle : config('admin.title');
    }


    public function menu()
    {
        if (!empty($this->menu)) {
            return $this->menu;
        }

        $menuClass = config('admin.database.menu_model');

        /** @var Menu $menuModel */
        $menuModel = new $menuClass();

        return $this->menu = $menuModel->toTree();
    }


    public function user()
    {
        return $this->guard()->user();
    }

    /**
     * Attempt to get the guard from the local cache.
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard()
    {
        $guard = config('admin.auth.guard') ?: 'admin';

        return Auth::guard($guard);
    }


    public function routes()
    {
        $attributes = [
            'prefix' => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ];
        app('router')->group($attributes, function ($router) {
            /* @var Route $router */
            $router->namespace('\SmallRuralDog\Admin\Controllers')->group(function ($router) {
                /* @var Router $router */
                $router->resource('auth/users', 'UserController')->names('admin.auth.users');
                $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
                $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
                $router->resource('auth/menu', 'MenuController', ['except' => ['create']])->names('admin.auth.menu');
                $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']])->names('admin.auth.logs');

                $router->post('_handle_form_', 'HandleController@handleForm')->name('admin.handle-form');
                $router->post('_handle_action_', 'HandleController@handleAction')->name('admin.handle-action');
            });
            $authController = config('admin.auth.controller', AuthController::class);
            /* @var Router $router */
            $router->get('auth/login', $authController . '@getLogin')->name('admin.login');
            $router->post('auth/login', $authController . '@postLogin')->name('admin.post.login');
            $router->get('auth/logout', $authController . '@getLogout')->name('admin.logout');
            $router->get('auth/setting', $authController . '@getSetting')->name('admin.setting');
            $router->put('auth/setting', $authController . '@putSetting');
        });
    }

    public function validatorData(array $all, $rules, $message = [])
    {
        $validator = \Validator::make($all, $rules, $message);
        if ($validator->fails()) {
            abort(400, $validator->errors()->first());
        }
        return $validator;
    }

    public function response($data, $message = '', $code = 200, $headers = [])
    {
        return \Response::json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], 200, $headers);
    }

    public function responseMessage($message = '', $code = 200)
    {
        return $this->response([], $message, $code);
    }

    public function responseError($message = '', $code = 400)
    {
        return $this->response([], $message, $code);
    }

    public function responseRedirect($url = '', $message = '', $code = 301)
    {
        return $this->response($url, $message, $code);
    }
}
