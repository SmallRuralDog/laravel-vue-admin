<?php


namespace SmallRuralDog\Admin;

use Admin;
use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SmallRuralDog\Admin\Form\FormAttrs;
use SmallRuralDog\Admin\Form\FormItem;
use SmallRuralDog\Admin\Form\TraitFormAttrs;

class Form implements Renderable
{
    use TraitFormAttrs;
    /**
     * @var Model|Builder
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

    protected $ignored = [];


    protected $updates = [];

    /**
     * Data for save to model's relations from input.
     *
     * @var array
     */
    protected $relations = [];

    /**
     * Input data.
     *
     * @var array
     */
    protected $inputs = [];

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

    protected function prepare($data = [])
    {

        $this->inputs = array_merge($this->removeIgnoredFields($data), $this->inputs);

        $this->relations = $this->getRelationInputs($this->inputs);

        $this->updates = Arr::except($this->inputs, array_keys($this->relations));

    }

    protected function removeIgnoredFields($input): array
    {
        Arr::forget($input, $this->ignored);

        return $input;
    }

    protected function getRelationInputs($inputs = []): array
    {
        $relations = [];

        foreach ($inputs as $column => $value) {
            $column = \Illuminate\Support\Str::camel($column);
            if (!method_exists($this->model, $column)) {
                continue;
            }
            $relation = call_user_func([$this->model, $column]);
            if ($relation instanceof Relation) {
                $relations[$column] = $value;
            }
        }
        return $relations;
    }

    protected function prepareInsert($inserts)
    {
        $prepared = [];
        foreach ($inserts as $key => $value) {
            Arr::set($prepared, $key, $value);
        }
        return $prepared;
    }

    public function getRelations(): array
    {
        $relations = [];
        $columns = collect($this->formItems)->map(function (FormItem $item) {
            return $item->getProp();
        })->toArray();

        foreach (Arr::flatten($columns) as $column) {
            if (Str::contains($column, '.')) {
                list($relation) = explode('.', $column);

                if (method_exists($this->model, $relation) &&
                    $this->model->$relation() instanceof Relation
                ) {
                    $relations[] = $relation;
                }
            } elseif (method_exists($this->model, $column)) {
                $relations[] = $column;
            }
        }
        return array_unique($relations);
    }


    public function store()
    {
        $data = request()->all();

        if ($validationMessages = $this->validatorData($data)) {
            return Admin::responseError($validationMessages);
        }

        $this->prepare($data);

        DB::transaction(function () use ($data) {
            $inserts = $this->prepareInsert($this->updates);
            foreach ($inserts as $key => $value) {
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
        $this->prepare($data);
        DB::transaction(function () use ($data) {
            foreach ($this->updates as $key => $value) {
                $this->model->setAttribute($key, $value);
            }
            $this->model->save();
        });
        return Admin::responseMessage(trans('admin::admin.update_succeeded'));
    }

    /**
     * 表单渲染
     * @return array|string
     * @throws \Throwable
     */
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

    /**
     * 获取编辑数据
     * @param $id
     * @return array
     */
    public function editData($id)
    {
        $this->setMode(self::MODE_EDIT);
        $this->setResourceId($id);
        $e_data = $this->model->with($this->getRelations())->findOrFail($this->getResourceId());
        $data = [];
        /**@var FormItem $formItem */
        foreach ($this->formItems as $formItem) {
            $field = $formItem->getField();
            $prop = $formItem->getProp();
            $data[$prop] = $e_data->{$prop};
        }
        return [
            'code' => 200,
            'data' => $data
        ];

    }

}
