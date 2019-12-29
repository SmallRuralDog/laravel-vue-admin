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

        $idColumn = $grid->column('id',"ID")->setMaxWidth(100);

        $nameColumn = $grid->column('name', '用户昵称');



        $grid->columns([
            $idColumn,
            $nameColumn
        ]);

        return $grid;
    }

}
