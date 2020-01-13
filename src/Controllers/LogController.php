<?php


namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Auth\Database\OperationLog;
use SmallRuralDog\Admin\Components\Avatar;
use SmallRuralDog\Admin\Components\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Layout\LvaContent;

class LogController extends AdminController
{


    protected function grid()
    {
        $grid = new Grid(new OperationLog());
        $grid->with(['user']);
        $grid->selection()
            ->perPage(10)
            ->defaultSort('id', 'desc')
            ->stripe()
            ->emptyText("暂无日志")
            ->pageBackground(true)
            ->size('small')->actionShowMore(false)->hideEditAction()->hideViewAction();
        $idColumn = $grid->column('id', "ID")->width("100");
        $nameColumn = $grid->column('user.name', 'User', 'user_id')->help("操作用户")->sortable();
        $grid->columns([
            $idColumn,
            $grid->column('user.avatar', 'Avatar', 'user_id')->displayComponent(Avatar::make()->size('small'))->width(80),
            $nameColumn,
            $grid->column('method')->width(100)->align('center')->displayComponent(Tag::make()->type(['GET' => 'info', 'POST' => 'success'])),
            $grid->column('path')->help('操作URL')->sortable(),
            $grid->column('ip'),
            $grid->column('created_at', "创建时间")->sortable()
        ]);
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new OperationLog());

        return $form;
    }

}
