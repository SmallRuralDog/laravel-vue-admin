<?php


namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Components\Avatar;
use SmallRuralDog\Admin\Components\Input;
use SmallRuralDog\Admin\Components\Select;
use SmallRuralDog\Admin\Components\SelectOption;
use SmallRuralDog\Admin\Components\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Layout\LvaContent;

class UserController extends AdminController
{


    protected function grid()
    {

        $userModel = config('admin.database.users_model');
        $grid = new Grid(new $userModel());
        $grid->pageBackground()->defaultSort('id', 'asc')->with(['roles:id,name', 'roles.permissions', 'roles.menus'])->selection()
            ->stripe(true)->emptyText("暂无用户")->perPage(10);
        $grid->columns([
            $grid->column('id', "ID")->width(80),
            $grid->column('avatar', '头像')->width(80)->align('center')->displayComponent(Avatar::make()->size('small')),
            $grid->column('username', trans('admin::admin.username')),
            $grid->column('name', '用户昵称'),
            $grid->column('roles.name', trans('admin::admin.roles'))->displayComponent(Tag::make()->effect('dark')),
            $grid->column('created_at', trans('admin::admin.created_at')),
            $grid->column('updated_at', trans('admin::admin.updated_at'))
        ]);
        return $grid;
    }

    protected function form()
    {


        $userModel = config('admin.database.users_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $form = new Form(new $userModel());


        $form->items([
            $form->item('username', '用户名')->displayComponent(Input::make()->prefixIcon('el-icon-eleme')),
            $form->item('name', '名称')->displayComponent(Input::make()->showWordLimit()->maxlength(20)),
            $form->item('avatar', '头像'),
            $form->item('password', '密码')->serveRules(['required', 'string', 'min:8', 'confirmed'])->displayComponent(Input::make()->password()->showPassword()),
            $form->item('password_confirmation', '确认密码')->displayComponent(Input::make()->password()->showPassword()),
            $form->item('roles', '角色')->displayComponent(Select::make()->block()->multiple()->options($roleModel::all()->map(function ($role) {
                return SelectOption::make($role->id, $role->name);
            })->toArray())),
            $form->item('permissions', '权限')->displayComponent(Select::make()->clearable()->block()->multiple()->options($permissionModel::all()->map(function ($role) {
                return SelectOption::make($role->id, $role->name);
            })->toArray())),
        ]);

        $form->saving(function (Form $form) {

        });

        return $form;
    }
}
