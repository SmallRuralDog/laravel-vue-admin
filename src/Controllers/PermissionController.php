<?php

namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Components\Input;
use SmallRuralDog\Admin\Components\Select;
use SmallRuralDog\Admin\Components\SelectOption;
use SmallRuralDog\Admin\Components\Tag;
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

        $grid->defaultSort('id', 'asc')->hideViewAction();

        $grid->columns([
            $grid->column('id', 'ID')->sortable()->width('80px'),
            $grid->column('slug', trans('admin::admin.slug')),
            $grid->column('name', trans('admin::admin.name')),
            $grid->column('http_method', trans('admin::admin.http_method'))->displayComponent(Tag::make()),
            $grid->column('http_path', trans('admin::admin.route'))->customValue(function ($row, $value) {
                return explode("\n", $value);
            })->displayComponent(function () {
                return Tag::make();
            })->width('400px'),
            $grid->column('created_at', trans('admin::admin.created_at')),
            $grid->column('updated_at', trans('admin::admin.updated_at'))
        ]);
        return $grid;
    }

    protected function form()
    {
        $permissionModel = config('admin.database.permissions_model');

        $form = new Form(new $permissionModel());
        $http_method = $form->item('http_method', trans('admin::admin.http.method'))
            ->help(trans('admin::admin.all_methods_if_empty'))
            ->displayComponent(function () {
                return Select::make()->multiple()
                    ->block()
                    ->clearable()
                    ->options($this->getHttpMethodsOptions());
            });

        $form->items([
            $form->item('slug', trans('admin::admin.slug'))
                ->rules([
                    ['required' => true, 'message' => '标识必填', 'trigger' => 'blur']
                ])
                ->serveRules("required", [
                    'required' => '标识必填'
                ]),
            $form->item('name', trans('admin::admin.name'))
                ->rules([
                    ['required' => true, 'message' => '必填', 'trigger' => 'blur']
                ]),
            $http_method,
            $form->item('http_path', trans('admin::admin.http.path'))->serveRules('required')->displayComponent(Input::make()->textarea(8))
        ]);

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
