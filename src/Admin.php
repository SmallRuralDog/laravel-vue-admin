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
    protected $menuList = [];
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

    public function menuList()
    {
        if (!empty($this->menuList)) {
            return $this->menuList;
        }

        $menuClass = config('admin.database.menu_model');

        /** @var Menu $menuModel */
        $menuModel = new $menuClass();

        return $this->menuList = $menuModel->get(['uri','title']);
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
