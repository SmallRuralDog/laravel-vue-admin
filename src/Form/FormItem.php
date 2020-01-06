<?php

namespace SmallRuralDog\Admin\Form;

use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Components\Input;
use SmallRuralDog\Admin\Form;

class FormItem
{
    protected $prop;
    protected $label;
    protected $labelWidth;
    protected $required = false;
    protected $rules;
    protected $error;
    protected $showMessage = true;
    protected $inlineMessage;
    protected $size;
    protected $help;

    /**
     * @var Form
     */
    protected $form;


    protected $serveRule;

    protected $component;

    /**
     * FormItem constructor.
     * @param $prop
     * @param $label
     */
    public function __construct($prop, $label)
    {
        $this->prop = $prop;
        $this->label = $this->formatLabel($label);
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

    public function displayComponent(Component $component)
    {
        $this->component = $component;
        return $this;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }


    /**
     * 后端验证规则
     * @param string|array $serveRule
     */
    public function serveRule($serveRule)
    {
        $this->serveRule = $serveRule;
    }


    public function getAttrs()
    {
        return [
            'prop' => $this->prop,
            'label' => $this->label,
            'labelWidth' => $this->labelWidth,
            'required' => $this->required,
            'rules' => $this->rules,
            'error' => $this->error,
            'showMessage' => $this->showMessage,
            'inlineMessage' => $this->inlineMessage,
            'size' => $this->size,
            'help' => $this->help,
            'component' => $this->component
        ];
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
     * 是否必填，如不设置，则会根据校验规则自动生成
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true)
    {
        $this->required = $required;
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

}
