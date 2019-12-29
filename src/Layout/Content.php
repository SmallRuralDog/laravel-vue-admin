<?php

namespace SmallRuralDog\Admin\Layout;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use SmallRuralDog\Admin\Facades\Admin;

class Content implements Renderable
{

    protected $showPageHeader = true;

    protected $title = '';

    protected $description = '';

    protected $breadcrumb = [];

    public function showPageHeader($val)
    {
        $this->showPageHeader = $val;
        return $this;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function description($description = '')
    {
        $this->description = $description;
        return $this;
    }

    public function breadcrumb(...$breadcrumb)
    {
        $this->validateBreadcrumb($breadcrumb);

        $this->breadcrumb = (array)$breadcrumb;

        return $this;
    }

    protected function validateBreadcrumb(array $breadcrumb)
    {
        foreach ($breadcrumb as $item) {
            if (!is_array($item) || !Arr::has($item, 'text')) {
                throw new  \Exception('Breadcrumb format error!');
            }
        }
        return true;
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
            'setting' => route('admin.setting'),
        ];
    }

    public function render()
    {


        $data = [
            'showPageHeader' => $this->showPageHeader,
            'title' => $this->title,
            'description' => $this->description,
            'menu'=>Admin::menu(),
            'breadcrumb'  => $this->breadcrumb,
            'logo' => config('admin.logo'),
            'logoMini' => config('admin.logo-mini'),
            'user' => $this->getUserData(),
            'url' => $this->getUrls()
        ];


        return view('admin::content', ['data' => $data])->render();
    }
}
