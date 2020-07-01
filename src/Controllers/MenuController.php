<?php

namespace SmallRuralDog\Admin\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SmallRuralDog\Admin\Auth\Database\Menu;
use SmallRuralDog\Admin\Components\Attrs\SelectOption;
use SmallRuralDog\Admin\Components\Form\IconChoose;
use SmallRuralDog\Admin\Components\Form\InputNumber;
use SmallRuralDog\Admin\Components\Form\Select;
use SmallRuralDog\Admin\Components\Grid\Icon;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class MenuController extends AdminController
{

    public function menuOrder(Request $request)
    {
        try {
            \Admin::validatorData($request->all(), [
                'self' => 'required',
                'target' => 'required',
                'type' => ['required', Rule::in(["before", "after", "inner"])],
            ]);

            $self_id = $request->input('self.id');
            $target_id = $request->input('target.id');
            $type = $request->input('type');
            $self_node = Menu::query()->findOrFail($self_id);
            $target_node = Menu::query()->findOrFail($target_id);

            switch ($type) {
                case "before":
                    Menu::query()->where('parent_id', $target_node->parent_id)
                        ->where('order', '>=', $target_node->order)
                        ->increment('order');
                    $self_node->parent_id = $target_node->parent_id;
                    $self_node->order = $target_node->order;
                    $self_node->save();
                    break;
                case "after":
                    Menu::query()->where('parent_id', $target_node->parent_id)
                        ->where('order', '>', $target_node->order)
                        ->increment('order');
                    $self_node->parent_id = $target_node->parent_id;
                    $self_node->order = $target_node->order + 1;
                    $self_node->save();
                    break;
                case "inner":
                    $self_node->parent_id = $target_node->id;
                    $self_node->order = 1;
                    $self_node->save();
                    break;
            }

        } catch (\Exception $exception) {
            return \Admin::responseError($exception->getMessage());
        }

    }

    protected function grid()
    {

        $userModel = config('admin.database.menu_model');
        $grid = new Grid(new $userModel());
        $grid->model()->where('parent_id', 0);
        $grid->model()->with(['children', 'roles', 'children.roles']);
        $grid
            ->defaultSort('order', 'asc')
            ->tree()
            ->emptyText("暂无菜单")
            ->quickSearch(["title"])
            ->defaultExpandAll(false)
        ->dialogForm($this->form()->isDialog()->labelPosition("top")->backButtonName("关闭")->className('p-15'));

        $grid->column('id', "ID")->width(80);
        $grid->column('icon', "图标")->component(Icon::make())->width(80);
        $grid->column('title', "名称");
        $grid->column('order', "排序");
        $grid->column('uri', "路径");
        $grid->column('roles.name', "授权角色")->component(Tag::make());

        return $grid;
    }

    protected function form()
    {
        /**@var Model $model */
        $model = config('admin.database.menu_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $form = new Form(new $model());

        $form->item('parent_id', '上级目录')->component(Select::make(0)->options(function () use ($model) {
            return $model::query()->where('parent_id', 0)->orderBy('order')->get()->map(function ($item) {
                return SelectOption::make($item->id, $item->title);
            })->prepend(SelectOption::make(0, '根目录'));
        }));
        $form->item('title', '名称')->required();
        $form->item('icon', trans('admin::admin.icon'))->component(IconChoose::make())->inputWidth(3)->required();

        $form->item('uri', trans('admin::admin.uri'))->required();
        $form->item('order', trans('admin::admin.order'))->component(InputNumber::make(1)->min(0));
        $form->item('roles', trans('admin::admin.roles'))->component(Select::make()->block()->multiple()->options(function () use ($roleModel) {
            return $roleModel::all()->map(function ($role) {
                return SelectOption::make($role->id, $role->name);
            });
        }));

        if ((new $model())->withPermission()) {
            $form->item('permission', trans('admin::admin.permission'))->component(Select::make()->clearable()->block()->multiple()->options(function () use ($permissionModel) {
                return $permissionModel::all()->map(function ($role) {
                    return SelectOption::make($role->id, $role->name);
                });
            }));
        };

        return $form;

    }
}
