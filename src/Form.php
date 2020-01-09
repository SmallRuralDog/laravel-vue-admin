<?php


namespace SmallRuralDog\Admin;

use Admin;
use DB;
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

    protected $id;

    protected $formItemsAttr = [];
    protected $formItemsValue = [];
    protected $formItems = [];

    const MODE_EDIT = 'edit';
    const MODE_CREATE = 'create';
    protected $mode = 'create';
    protected $action;

    protected $dataUrl;

    /**
     * Form constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->attrs = new FormAttrs();
        $this->model = new $model;
        $this->dataUrl = request()->getUri();
    }


    /**
     * 生成字段
     * @param $prop
     * @param string $label
     * @param string $field
     * @return FormItem
     */
    public function item($prop, $label = '', $field = '')
    {
        return $this->addItem($prop, $label, $field);
    }

    /**
     * @param $prop
     * @param $label
     * @param $field
     * @return FormItem
     */
    protected function addItem($prop, $label, $field)
    {
        $item = new FormItem($prop, $label, $field);
        $item->setForm($this);
        return $item;
    }


    /**
     * 设置字段组
     * @param array $items
     */
    public function items($items = [])
    {

        $this->formItems = $items;

        $this->formItemsAttr = collect($items)->map(function (FormItem $item) {
            return $item->getAttrs();
        });
        /**@var FormItem $item */
        foreach ($items as $item) {
            $this->formItemsValue[$item->getProp()] = $item->getDefaultValue();
        }

    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        if ($this->action) {
            return $this->action;
        }
        if ($this->isMode(static::MODE_EDIT)) {
            return $this->resource() . '/' . $this->id;
        }

        if ($this->isMode(static::MODE_CREATE)) {
            return $this->resource(-1);
        }

        return '';
    }

    /**
     * @param string $action
     * @return $this
     */
    public function action($action)
    {
        $this->action = $action;
        return $this;
    }


    protected function setMode($mode = 'create')
    {
        $this->mode = $mode;
    }


    public function isMode($mode): bool
    {
        return $this->mode === $mode;
    }

    public function setResourceId($id)
    {
        $this->id = $id;
    }

    public function getResourceId()
    {
        return $this->id;
    }

    public function resource($slice = -2): string
    {
        $segments = explode('/', trim(\request()->getUri(), '/'));

        if ($slice !== 0) {
            $segments = array_slice($segments, 0, $slice);
        }

        return implode('/', $segments);
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }




    /**
     * 获取模型
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @param $data
     * @return string
     */
    protected function validatorData($data)
    {
        try {
            $rules = [];
            $ruleMessages = [];
            /* @var FormItem $formItem */
            foreach ($this->formItems as $formItem) {
                if (empty($formItem->getServeRole())) continue;
                $rules[$formItem->getField()] = $formItem->getServeRole();
                $messages = $formItem->getServeRulesMessage();
                if (is_array($messages)) {
                    foreach ($messages as $key => $message) {
                        $ruleMessages[$formItem->getField() . '.' . $key] = $message;
                    }
                }
            }
            Admin::validatorData($data, $rules, $ruleMessages);
            return false;
        } catch (\Exception $exception) {
            return $exception->getMessage();//\Admin::responseError();
        }
    }

    public function store()
    {
        $data = request()->all();

        if ($validationMessages = $this->validatorData($data)) {
            return Admin::responseError($validationMessages);
        }

        DB::transaction(function () use ($data) {
            foreach ($data as $key => $value) {
                $this->model->setAttribute($key, $value);
            }
            $this->model->save();
        });
        return Admin::responseMessage(trans('admin::admin.save_succeeded'));
    }

    /**
     * 编辑
     * @param $id
     * @return array|string
     */
    public function edit($id)
    {

        $this->setMode(self::MODE_EDIT);

        $this->setResourceId($id);

        return $this->render();
    }

    /**
     * 模型删除
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            collect(explode(',', $id))->filter()->each(function ($id) {
                $builder = $this->model()->newQuery();
                $model = $builder->findOrFail($id);
                $model->delete();
            });
            return \Admin::responseMessage(trans('admin::admin.delete_succeeded'));
        } catch (\Exception $exception) {
            return \Admin::responseError($exception->getMessage() ?: trans('admin::admin.delete_failed'));
        }
    }

    public function update($id, $data = null)
    {
        $data = ($data) ?: request()->all();


        if ($validationMessages = $this->validatorData($data)) {
            return Admin::responseError($validationMessages);
        }

        $builder = $this->model();

        $this->model = $builder->findOrFail($id);
        DB::transaction(function () use ($data) {
            foreach ($data as $key => $value) {
                $this->model->setAttribute($key, $value);
            }
            $this->model->save();
        });


        return Admin::responseMessage(trans('admin::admin.update_succeeded'));
    }

    public function render()
    {
        $viewData = [
            'action' => $this->getAction(),
            'dataUrl' => $this->dataUrl,
            'mode' => $this->getMode(),
            'attrs' => $this->attrs,
            'formItems' => $this->formItemsAttr,
            'defaultValues' => $this->formItemsValue,
        ];

        return view('admin::form.base-form', $viewData)->render();
    }

    public function editData($id)
    {
        $this->setMode(self::MODE_EDIT);

        $this->setResourceId($id);

        $data = $this->model->findOrFail($this->getResourceId());

        return [
            'code' => 200,
            'data' => $data
        ];

    }
}
