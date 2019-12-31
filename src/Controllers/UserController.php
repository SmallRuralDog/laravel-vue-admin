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
        $grid->setStripe(true)->setBorder(false)->setHeight(500)->setEmptyText("暂无用户")->setPerPage(10);


        $idColumn = $grid->column('id', "ID")->setWidth("100")->setSortable(true);
        $nameColumn = $grid->column('name', '用户昵称')->setHelp("表头帮助说明");

        $grid->columns([
            $idColumn,
            $nameColumn,
        ]);
        return $grid;
    }

}
