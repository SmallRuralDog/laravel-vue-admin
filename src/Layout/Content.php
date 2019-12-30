<?php

namespace SmallRuralDog\Admin\Layout;

use Closure;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use SmallRuralDog\Admin\Facades\Admin;

class Content implements Renderable
{

    protected $showPageHeader = true;

    protected $title = '';

    protected $description = '';

    protected $breadcrumb = [];

    protected $rows = [];

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

    public function body($content)
    {
        return $this->row($content);
    }

    public function row($content)
    {
        if ($content instanceof Closure) {
            $row = new Row();
            call_user_func($content, $row);
            $this->addRow($row);
        } else {
            $this->addRow(new Row($content));
        }
        return $this;
    }

    protected function addRow(Row $row)
    {
        $this->rows[] = $row;
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

    public function build()
    {
        $contents = collect($this->rows)->map(function (Row $row) {
            return $row->build();
        });
        return $contents->join('');
    }

    public function render()
    {


        $data = [
            'showPageHeader' => $this->showPageHeader,
            'title' => $this->title,
            'description' => $this->description,
            'menu' => Admin::menu(),
            'url_current' => url()->current(),
            'breadcrumb' => $this->breadcrumb,
            'logo' => config('admin.logo'),
            'logoMini' => config('admin.logo-mini'),
            'user' => $this->getUserData(),
            'url' => $this->getUrls()
        ];


        return view('admin::content', ['data' => $data, 'content' => $this->build()])->render();
    }
}
