<?php


namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Grid;

class UserController extends AdminController
{

    protected function showPageHeader()
    {
        return false;
    }

    protected function title()
    {
        return trans('admin.administrator');
    }

    protected function grid()
    {

        $userModel = config('admin.database.users_model');
        $grid = new Grid(new $userModel());
        $grid->defaultSort('id','asc')->with(['roles:id,name','roles.permissions','roles.menus'])->selection();
        $grid->setStripe(true)->setEmptyText("暂无用户")->setPerPage(10);
        $idColumn = $grid->column('id', "ID")->setWidth("100")->setSortable();
        $nameColumn = $grid->column('name', '用户昵称');
        $grid->columns([
            $idColumn,
            $grid->column('username', trans('admin.username')),
            $nameColumn,
            $grid->column('roles.name', trans('admin.roles')),
            $grid->column('roles.menus.title', trans('admin.roles')),
            $grid->column('created_at', trans('admin.created_at')),
            $grid->column('updated_at', trans('admin.updated_at'))
        ]);
        return $grid;
    }

}
