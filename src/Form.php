<?php


namespace SmallRuralDog\Admin;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use SmallRuralDog\Admin\Form\FormAttrs;
use SmallRuralDog\Admin\Form\FormItem;
use SmallRuralDog\Admin\Form\TraitFormAttrs;

class Form implements Renderable
{
    use TraitFormAttrs;
    /**
     * @var Model
     */
    protected $model;

    protected $formItems = [];

    /**
     * Form constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->attrs = new FormAttrs();
        $this->model = $model;
    }


    /**
     * @param $prop
     * @param string $label
     * @return FormItem
     */
    public function item($prop, $label = '')
    {
        return $this->addItem($prop, $label);
    }

    /**
     * @param $prop
     * @param $label
     * @return FormItem
     */
    protected function addItem($prop, $label)
    {
        $item = new FormItem($prop, $label);
        $item->setForm($this);
        return $item;
    }


    public function items($items = [])
    {
        $this->formItems = collect($items)->map(function (FormItem $item) {
            return $item->getAttrs();
        });
    }

    /**
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    public function edit($id){
        return $this->render();
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


        $viewData = [
            'attrs' => $this->attrs,
            'formItems' => $this->formItems
        ];

        return view('admin::form.base-form', $viewData)->render();
    }
}
