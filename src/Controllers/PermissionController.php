<?php

namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Components\Attrs\SelectOption;
use SmallRuralDog\Admin\Components\Form\Input;
use SmallRuralDog\Admin\Components\Form\Select;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class PermissionController extends AdminController
{
    protected function showPageHeader()
    {
        return false;
    }

    protected function title()
    {
        return trans('admin::admin.permissions');
    }

    protected function grid()
    {
        $permissionModel = config('admin.database.permissions_model');

        $grid = new Grid(new $permissionModel());

        $grid->defaultSort('id', 'asc');

        $grid->quickSearch(['slug', 'name']);
        $grid->column('id', 'ID')->sortable()->width('80px');
        $grid->column('slug', "标识")->width(120);
        $grid->column('name', "名称")->width(120);
        $grid->column('http_method', "请求方式")->component(Tag::make());
        $grid->column('http_path', "路由")->customValue(function ($row, $value) {
            return explode("\n", $value);
        })->component(function () {
            return Tag::make();
        });


        $grid->actions(function (Grid\Actions $actions) {
            $actions->hideViewAction();
        });

        $grid->dialogForm($this->form()->isDialog());

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $permissionModel = config('admin.database.permissions_model');

        $form = new Form(new $permissionModel());

        $form->labelPosition("top");


        $form->item('slug', "标识")->required();
        $form->item('name', "名称")->required();
        $form->item('http_method', "请求方式")
            ->help("为空默认为所有方法")
            ->component(function () {
                return Select::make()->multiple()
                    ->block()
                    ->clearable()
                    ->options($this->getHttpMethodsOptions());
            });
        $form->item('http_path', "路由")->required()->component(Input::make()->textarea(8));


        return $form;
    }

    protected function getHttpMethodsOptions()
    {
        $model = config('admin.database.permissions_model');

        return collect($model::$httpMethods)->map(function ($item) {
            return SelectOption::make($item, $item);
        })->toArray();
    }
}
