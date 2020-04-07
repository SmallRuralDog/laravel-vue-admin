<?php


namespace SmallRuralDog\Admin\Controllers;

use Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class RootController extends Controller
{
    public function index()
    {
        $data = [
            'isLocal'=>config('app.env')=="local",
            'menu' => Admin::menu(),
            'menuList' => Admin::menuList(),
            'logoShow' => config('admin.logo_show'),
            'logo' => config('admin.logo'),
            'logoLight' => config('admin.logo_light'),
            'logoMini' => config('admin.logo_mini'),
            'logoMiniLight' => config('admin.logo_mini_light'),
            'name' => config('admin.name'),
            'copyright' => config('admin.copyright'),
            'footerLinks' => config('admin.footerLinks'),
            'user' => $this->getUserData(),
            'url' => $this->getUrls()
        ];


        return view('admin::root', ['data' => $data]);
    }




    protected function getUserData()
    {
        if (!$user = Admin::user()) {
            return [];
        }
        return Arr::only($user->toArray(), ['id', 'username', 'email', 'name', 'avatar']);
    }

    protected function getUrls()
    {
        return [
            'logout' => route('admin.logout'),
            'setting' => route('admin.setting')
        ];
    }
}
