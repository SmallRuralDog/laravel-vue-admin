<?php

namespace SmallRuralDog\Admin\Form;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Components\Form\Input;
use SmallRuralDog\Admin\Form;

class FormItem
{
    protected $prop;
    protected $label;
    protected $field;
    protected $labelWidth;
    protected $inputWidth = 24;
    protected $required = false;
    protected $rules;
    protected $error;
    protected $showMessage = true;
    protected $inlineMessage;
    protected $size;
    protected $help;
    protected $defaultValue;
    protected $copyProp;
    protected $relationName;
    protected $relationValueKey;
    protected $ignoreEmpty = false;
    protected $hiddenMode = '';

    /**
     * @var string
     */
    protected $tab = "基本信息";

    /**
     * @var Form
     */
    protected $form;
    protected $serveRules;
    protected $serveCreationRules;
    protected $serveUpdateRules;
    protected $serveRulesMessage;
    /**
     * @var Component
     */
    protected $component;
    protected $topComponent;
    protected $footerComponent;

    public $original;

    protected $vif = [
        'key' => null,
        'value' => null,
        'anyValue' => false,
    ];

    /**
     * FormItem constructor.
     * @param $prop
     * @param $label
     * @param $field
     */
    public function __construct($prop, $label, $field)
    {
        $this->prop = $prop;
        $this->label = $this->formatLabel($label);
        $this->field = $field;
        if (empty($this->field)) {
            $this->field = $this->prop;
        }

        if (Str::contains($prop, '.')) {
            list($relationName, $relationValueKey) = explode('.', $prop);
            $this->relationName = $relationName;
            $this->relationValueKey = $relationValueKey;
        }

        $this->component = Input::make();
    }

    protected function formatLabel($label)
    {
        if ($label) {
            return $label;
        }
        $label = ucfirst($this->prop);
        return __(str_replace(['.', '_'], ' ', $label));
    }

    public function setOriginal($data)
    {
        $this->original = Arr::get($data, $this->prop);
    }

    /**
     * 设置头部组件
     * @param $component
     * @return $this
     */
    public function topComponent($component)
    {
        if ($component instanceof \Closure) {
            $this->topComponent = call_user_func($component);
        } else {
            $this->topComponent = $component;
        }
        return $this;
    }

    /**
     * 设置底部组件
     * @param $component
     * @return $this
     */
    public function footerComponent($component)
    {
        if ($component instanceof \Closure) {
            $this->footerComponent = call_user_func($component);
        } else {
            $this->footerComponent = $component;
        }
        return $this;
    }

    /**
     * @deprecated
     * @param $component
     * @return $this
     */
    public function displayComponent($component)
    {
        if ($component instanceof \Closure) {
            $this->component = call_user_func($component);
        } else {
            $this->component = $component;
        }
        return $this;
    }

    /**
     * 设置组件
     * @param $component
     * @return $this
     */
    public function component($component)
    {
        if ($component instanceof \Closure) {
            $this->component = call_user_func($component);
        } else {
            $this->component = $component;
        }
        return $this;
    }

    public function getDisplayComponent()
    {
        return $this->component;
    }

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @return mixed
     */
    public function getProp()
    {
        return $this->prop;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * 后端验证规则
     * @param string|array $serveRules
     * @return $this
     */
    public function serveRules($serveRules)
    {
        $this->serveRules = $serveRules;
        return $this;
    }

    /**
     * @param mixed $serveCreationRules
     * @return FormItem
     */
    public function serveCreationRules($serveCreationRules)
    {
        $this->serveCreationRules = $serveCreationRules;
        return $this;
    }

    /**
     * @param mixed $serveUpdateRules
     * @return FormItem
     */
    public function serveUpdateRules($serveUpdateRules)
    {
        $this->serveUpdateRules = $serveUpdateRules;
        return $this;
    }

    /**
     * @param mixed $serveRulesMessage
     * @return FormItem
     */
    public function serveRulesMessage($serveRulesMessage)
    {
        $this->serveRulesMessage = $serveRulesMessage;
        return $this;
    }

    /**
     * 设置默认值
     * @param mixed $defaultValue
     * @return $this
     */
    public function defaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        if($this->component) $this->component->componentValue($defaultValue);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue ? $this->defaultValue : $this->component->getComponentValue();
    }

    /**
     * 复制其他组件的值
     * @param string $copyProp
     * @return $this
     */
    public function copyValue($copyProp)
    {
        $this->copyProp = $copyProp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCopyProp()
    {
        return $this->copyProp;
    }

    public function getData($data, $model, $component)
    {
        if (!method_exists($model, $this->prop)) {
            if (method_exists($component, "getValue")) {
                return $component->getValue($data);
            }
            return $data;
        } else {
            if ($model->{$this->prop}() instanceof BelongsToMany) {
                /**@var BelongsToMany $re */
                $re = $model->{$this->prop}();
                $data = collect($data)->pluck($re->getRelatedKeyName());
            }
        }
        return $data;
    }

    public function getServeRole()
    {

        if (request()->isMethod('POST')) {
            $rules = $this->serveCreationRules ?: $this->serveRules;
        } elseif (request()->isMethod('PUT')) {
            $rules = $this->serveUpdateRules ?: $this->serveRules;
        } else {
            $rules = $this->rules;
        }

        if ($rules instanceof \Closure) {
            $rules = $rules->call($this, $this->form);
        }

        if (is_string($rules)) {
            $rules = array_filter(explode('|', $rules));
        }

        if (!$this->form) {
            return $rules;
        }

        if (!$id = $this->form->model()->getKey()) {
            return $rules;
        }

        if (is_array($rules)) {
            foreach ($rules as &$rule) {
                if (is_string($rule)) {
                    $rule = str_replace('{{id}}', $id, $rule);
                }
            }
        }

        return $rules;
    }

    /**
     * @return mixed
     */
    public function getServeRulesMessage()
    {
        return $this->serveRulesMessage;
    }

    /**
     * 表单域标签的的宽度，例如 '50px'。支持 auto
     * @param mixed $labelWidth
     * @return $this
     */
    public function labelWidth($labelWidth)
    {
        $this->labelWidth = $labelWidth;
        return $this;
    }

    /**
     * 表单域输入区域宽度  1 - 24
     * @param int $inputWidth
     * @return $this
     */
    public function inputWidth(int $inputWidth)
    {
        $this->inputWidth = $inputWidth;
        return $this;
    }

    /**
     * 是否必填，如不设置，则会根据校验规则自动生成
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true)
    {
        $this->required = $required;
        if (!$this->serveRules) {
            $this->serveRules('required');
            $this->serveRulesMessage(['required' => '请填写' . $this->label]);
        }
        if (!$this->rules) {
            $this->rules([
                ['required' => true, "message" => "请填写" . $this->label],
            ]);
        }

        return $this;
    }

    /**
     * 表单验证规则
     * @param mixed $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * 表单域验证错误信息, 设置该值会使表单验证状态变为error，并显示该错误信息
     * @param string $error
     * @return $this
     */
    public function error($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * 是否显示校验错误信息
     * @param bool $showMessage
     * @return $this
     */
    public function showMessage(bool $showMessage = true)
    {
        $this->showMessage = $showMessage;
        return $this;
    }

    /**
     * 以行内形式展示校验信息
     * @param bool $inlineMessage
     * @return $this
     */
    public function inlineMessage($inlineMessage = true)
    {
        $this->inlineMessage = $inlineMessage;
        return $this;
    }

    /**
     * 用于控制该表单域下组件的尺寸
     * medium / small / mini
     * @param mixed $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 帮助信息，支持html
     * @param $help
     * @return $this
     */
    public function help($help)
    {
        $this->help = $help;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function vif($key, $value, $anyValue = false)
    {
        $this->vif = [
            'key' => $key,
            'value' => $value,
            'anyValue' => $anyValue,
        ];
        return $this;
    }

    /**
     * 设置字段所属tab名称
     * @param string $tab
     * @return FormItem
     */
    public function tab(string $tab)
    {
        $this->tab = $tab;
        return $this;
    }

    /**
     * @return string
     */
    public function getTab(): string
    {
        return $this->tab;
    }

    /**
     * If Null Dont Return
     * @return $this
     */
    public function ignoreEmpty()
    {
        $this->ignoreEmpty = true;
        return $this;
    }
    /**
     * 传递当前组件所在模式
     * @param  string $value
     * @return $this
     */
    public function hiddenMode($value = '')
    {
        $this->hiddenMode = $value;
        return $this;
    }
    /**
     * @return mixed
     */
    public function hiddenInCreate()
    {
        $this->hiddenMode = Form::MODE_CREATE;
        return $this;
    }
    /**
     * @return mixed
     */
    public function hiddenInEdit()
    {
        $this->hiddenMode = Form::MODE_EDIT;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getHiddenMode()
    {
        return $this->hiddenMode;
    }
    public function getAttrs()
    {
        return [
            'prop' => $this->prop,
            'label' => $this->label,
            'field' => $this->field,
            'labelWidth' => $this->labelWidth,
            'inputWidth' => $this->inputWidth,
            'required' => $this->required,
            'rules' => $this->rules,
            'error' => $this->error,
            'showMessage' => $this->showMessage,
            'inlineMessage' => $this->inlineMessage,
            'size' => $this->size,
            'help' => $this->help,
            'component' => $this->component,
            'topComponent' => $this->topComponent,
            'footerComponent' => $this->footerComponent,
            'relationName' => $this->relationName,
            'relationValueKey' => $this->relationValueKey,
            'vif' => $this->vif,
            'tab'=>$this->tab,
            'ignoreEmpty' => $this->ignoreEmpty,
            'hiddenMode' => $this->hiddenMode,
        ];
    }

}
