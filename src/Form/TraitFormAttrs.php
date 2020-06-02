<?php


namespace SmallRuralDog\Admin\Form;


trait TraitFormAttrs
{
    /**
     * @var FormAttrs
     */
    public $attrs;

    public function className($className)
    {
        $this->attrs->className = $className;
        return $this;
    }

    public function style($style)
    {
        $this->attrs->style = $style;
        return $this;
    }

    /**
     * 表单验证规则
     * @param array $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->attrs->rules = $rules;
        return $this;
    }

    /**
     * 行内表单模式
     * @param bool $inline
     * @return $this
     */
    public function inline(bool $inline = true)
    {
        $this->attrs->inline = $inline;
        return $this;
    }

    /**
     * 表单域标签的位置，如果值为 left 或者 right 时，则需要设置 label-width
     * right/left/top
     * @param string $labelPosition
     * @return $this
     */
    public function labelPosition(string $labelPosition)
    {
        $this->attrs->labelPosition = $labelPosition;
        return $this;
    }

    /**
     * 表单域标签的宽度，例如 '50px'。作为 Form 直接子元素的 form-item 会继承该值。支持 auto
     * @param string $labelWidth
     * @return $this
     */
    public function labelWidth(string $labelWidth)
    {
        $this->attrs->labelWidth = $labelWidth;
        return $this;
    }

    /**
     * 表单域标签的后缀
     * @param string $labelSuffix
     * @return $this
     */
    public function labelSuffix(string $labelSuffix)
    {
        $this->attrs->labelSuffix = $labelSuffix;
        return $this;
    }

    /**
     * 是否显示必填字段的标签旁边的红色星号
     * @param bool $hideRequiredAsterisk
     * @return $this
     */
    public function hideRequiredAsterisk(bool $hideRequiredAsterisk = true)
    {
        $this->attrs->hideRequiredAsterisk = $hideRequiredAsterisk;
        return $this;
    }

    /**
     * 是否显示校验错误信息
     * @param bool $showMessage
     * @return $this
     */
    public function showMessage(bool $showMessage = true)
    {
        $this->attrs->showMessage = $showMessage;
        return $this;
    }

    /**
     *
     * 是否以行内形式展示校验信息
     * @param bool $inlineMessage
     * @return $this
     */
    public function inlineMessage(bool $inlineMessage = true)
    {
        $this->attrs->inlineMessage = $inlineMessage;
        return $this;
    }

    /**
     * 是否在输入框中显示校验结果反馈图标
     * @param bool $statusIcon
     * @return $this
     */
    public function statusIcon(bool $statusIcon = true)
    {
        $this->attrs->statusIcon = $statusIcon;
        return $this;
    }

    /**
     * 是否在 rules 属性改变后立即触发一次验证
     * @param bool $validateOnRuleChange
     * @return $this
     */
    public function validateOnRuleChange(bool $validateOnRuleChange = true)
    {
        $this->attrs->validateOnRuleChange = $validateOnRuleChange;
        return $this;
    }

    /**
     * 用于控制该表单内组件的尺寸
     * @param mixed $size
     * @return $this
     */
    public function size($size)
    {
        $this->attrs->size = $size;
        return $this;
    }

    /**
     * 是否禁用该表单内的所有组件。若设置为 true，则表单内组件上的 disabled 属性不再生效
     * @param bool $disabled
     * @return $this
     */
    public function disabled(bool $disabled = true)
    {
        $this->attrs->disabled = $disabled;
        return $this;
    }

    /**
     * 隐藏tab
     * @param bool $hideTab
     * @return $this
     */
    public function hideTab(bool $hideTab = true)
    {
        $this->attrs->hideTab = $hideTab;
        return $this;
    }

    /**
     * 创建按钮名称
     * @param $createButtonName
     * @return $this
     */
    public function createButtonName($createButtonName)
    {
        $this->attrs->createButtonName = $createButtonName;
        return $this;
    }

    /**
     * 修改按钮名称
     * @param $updateButtonName
     * @return $this
     */
    public function updateButtonName($updateButtonName)
    {
        $this->attrs->updateButtonName = $updateButtonName;
        return $this;
    }

    /**
     * 返回按钮名称
     * @param $backButtonName
     * @return $this
     */
    public function backButtonName($backButtonName)
    {
        $this->attrs->backButtonName = $backButtonName;
        return $this;
    }

    public function buttonWidth($buttonWidth)
    {
        $this->attrs->buttonWidth = $buttonWidth;
        return $this;
    }

    /**
     * 弹窗模式
     * @return $this
     */
    public function isDialog()
    {
        $this->attrs->isDialog = true;
        $this->action = $this->resource(0);
        return $this;
    }
}
