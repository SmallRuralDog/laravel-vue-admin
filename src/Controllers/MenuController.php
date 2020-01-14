<?php


namespace SmallRuralDog\Admin\Controllers;


use Illuminate\Database\Eloquent\Model;
use SmallRuralDog\Admin\Components\InputNumber;
use SmallRuralDog\Admin\Components\Select;
use SmallRuralDog\Admin\Components\SelectOption;
use SmallRuralDog\Admin\Components\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class MenuController extends AdminController
{
    protected function grid()
    {

        $userModel = config('admin.database.menu_model');
        $grid = new Grid(new $userModel());
        $grid->pageBackground()
            ->defaultSort('id', 'asc')
            ->stripe(true)
            ->emptyText("暂无菜单")
            ->perPage(10);
        $grid->columns([
            $grid->column('id', "ID"),
            $grid->column('title', "Title"),
            $grid->column('uri', "Uri"),
            $grid->column('icon', "icon"),
            $grid->column('roles.name', trans('admin::admin.roles'))->displayComponent(Tag::make()),
            $grid->column('order', "order"),
        ]);


        return $grid;
    }

    protected function form()
    {
        /**@var Model $model */
        $model = config('admin.database.menu_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $form = new Form(new $model());
        $items = [
            $form->item('parent_id', '上级目录')->displayComponent(Select::make()->options(function () use ($model) {
                return $model::query()->where('parent_id', 0)->get()->map(function ($item) {
                    return SelectOption::make($item->id, $item->title);
                })->prepend(SelectOption::make(0, '根目录'));
            })),
            $form->item('title', '名称')->required(),
            $form->item('icon', trans('admin::admin.icon')),
            $form->item('uri', trans('admin::admin.uri'))->required(),
            $form->item('order',trans('admin::admin.order'))->displayComponent(InputNumber::make()->min(0)),
            $form->item('roles', trans('admin::admin.roles'))->displayComponent(Select::make()->block()->multiple()->options(function () use ($roleModel) {
                return $roleModel::all()->map(function ($role) {
                    return SelectOption::make($role->id, $role->name);
                });
            })),
        ];
        if ((new $model())->withPermission()) {
            $items = collect($items)->add($form->item('permission', trans('admin::admin.permission'))->displayComponent(Select::make()->clearable()->block()->multiple()->options(function () use ($permissionModel) {
                return $permissionModel::all()->map(function ($role) {
                    return SelectOption::make($role->id, $role->name);
                });
            })));
        };

        $form->items($items);


        return $form;

    }
}
