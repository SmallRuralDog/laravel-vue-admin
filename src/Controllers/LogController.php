<?php


namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Auth\Database\OperationLog;
use SmallRuralDog\Admin\Components\Avatar;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class LogController extends AdminController
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


        $grid = new Grid(new OperationLog());
        $grid->with(['user']);
        $grid->selection(false)
            ->setPerPage(10)
            ->defaultSort('id', 'desc')
            ->selection()
            ->setStripe(true)
            ->setBorder(false)
            ->setEmptyText("暂无日志")
            ->setPageBackground(true)
            //->setActionShowMore()
            ->setSize('small');
        $idColumn = $grid->column('id', "ID")->setWidth("100");
        $nameColumn = $grid->column('user.name', 'User', 'user_id')->setHelp("操作用户")->setSortable();
        $grid->columns([
            $idColumn,
            $grid->column('user.avatar', 'Avatar', 'user_id')->displayComponent(Avatar::make())->setWidth(80),
            $nameColumn,
            $grid->column('method')->setWidth(100)->setAlign('center'),
            $grid->column('path')->setHelp('操作URL')->setSortable(),
            $grid->column('ip'),
            $grid->column('created_at', "创建时间")->setSortable()
        ]);
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new OperationLog());

        return $form;
    }

}
