<?php


namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Components\Tag;
use SmallRuralDog\Admin\Components\Transfer;
use SmallRuralDog\Admin\Components\TransferData;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class RoleController extends AdminController
{


    protected function grid()
    {
        $roleModel = config('admin.database.roles_model');

        $grid = new Grid(new $roleModel());

        $grid->columns([
            $grid->column('id', 'ID')->width('80px')->sortable(),
            $grid->column('slug', trans('admin::admin.slug')),
            $grid->column('name', trans('admin::admin.name')),
            $grid->column('permissions.name', trans('admin::admin.permission'))->displayComponent(Tag::make()->type('info')),
            $grid->column('created_at', trans('admin::admin.created_at')),
            $grid->column('updated_at', trans('admin::admin.updated_at'))
        ]);

        return $grid;
    }

    public function form()
    {
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $form = new Form(new $roleModel());


        $form->items([
            $form->item('slug', trans('admin::admin.slug'))->required()->serveRules('required'),
            $form->item('name', trans('admin::admin.name'))->required()->serveRules('required'),
            $form->item('permissions', trans('admin::admin.permissions'), 'permissions.id')->displayComponent(
                Transfer::make()->data($permissionModel::get()->map(function ($item) {
                    return TransferData::make($item->id, $item->name);
                }))->titles(['可授权', '已授权'])->filterable()
            )
        ]);

        return $form;
    }
}
