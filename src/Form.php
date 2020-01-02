<?php


namespace SmallRuralDog\Admin;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;

class Form implements Renderable
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Form constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    public function destroy($id)
    {
        try {
            collect(explode(',', $id))->filter()->each(function ($id) {
                $builder = $this->model()->newQuery();
                $model = $builder->findOrFail($id);
                $model->delete();
            });
            return \Admin::responseMessage(trans('admin.delete_succeeded'));
        } catch (\Exception $exception) {
            return \Admin::responseError($exception->getMessage() ?: trans('admin.delete_failed'));
        }
    }


    public function render()
    {
        $viewData = [];

        return view('admin::form.base-form', $viewData)->render();
    }
}
