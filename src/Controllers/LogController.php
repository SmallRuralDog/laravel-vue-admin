<?php


namespace SmallRuralDog\Admin\Controllers;


use SmallRuralDog\Admin\Auth\Database\OperationLog;

use SmallRuralDog\Admin\Components\Grid\Avatar;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class LogController extends AdminController
{


    protected function grid()
    {
        $grid = new Grid(new OperationLog());
        $grid->perPage(20)
            ->quickSearch()
            ->selection()
            ->defaultSort('id', 'desc')
            ->stripe()
            ->emptyText("暂无日志")
            ->height('auto');


        $grid->column('id', "ID")->width("100");
        $grid->column('user.avatar', '头像', 'user_id')->component(Avatar::make()->size('small'))->width(80);
        $grid->column('user.name', '用户', 'user_id')->help("操作用户")->sortable();
        $grid->column('method', '请求方式')->width(100)->align('center')->component(Tag::make()->type(['GET' => 'info', 'POST' => 'success']));
        $grid->column('path', '路径')->help('操作URL')->sortable();
        $grid->column('ip', 'IP');
        $grid->column('created_at', "创建时间")->sortable();

        $grid->actions(function (Grid\Actions $actions) {
            $actions->hideEditAction();
            $actions->hideViewAction();
        })->toolbars(function (Grid\Toolbars $toolbars) {
            $toolbars->hideCreateButton();
        });
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new OperationLog());

        return $form;
    }

}
