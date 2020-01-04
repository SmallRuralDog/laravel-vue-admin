<?php


namespace SmallRuralDog\Admin\Components;


class Checkbox extends Component
{
    public $componentName = "Checkbox";

    public $label;
    public $trueLabel;
    public $falseLabel;
    public $disabled = false;
    public $border = false;
    public $size;
    public $name;
    public $checked = false;
    public $indeterminate = false;
    public $title;


    /**
     * @param string|int|bool $label
     * @param string $title
     * @return Checkbox
     */
    static public function make($label, $title = null)
    {

        $title = $title ?: $label;

        return (new Checkbox($label))->setLabel($label)->setTitle($title);
    }

    /**
     * 选中状态的值（只有在checkbox-group或者绑定对象类型为array时有效）
     * @param string|int|bool $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * 选中时的值
     * @param string|int $trueLabel
     * @return $this
     */
    public function setTrueLabel($trueLabel)
    {
        $this->trueLabel = $trueLabel;
        return $this;
    }

    /**
     * 没有选中时的值
     * @param string|int $falseLabel
     * @return $this
     */
    public function setFalseLabel($falseLabel)
    {
        $this->falseLabel = $falseLabel;
        return $this;
    }

    /**
     * 是否禁用
     * @param bool $disabled
     * @return $this
     */
    public function setDisabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 是否显示边框
     * @param bool $border
     * @return $this
     */
    public function setBorder(bool $border = true)
    {
        $this->border = $border;
        return $this;
    }

    /**
     * Checkbox 的尺寸，仅在 border 为真时有效
     * @param string $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 原生 name 属性
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 当前是否勾选
     * @param bool $checked
     * @return $this
     */
    public function setChecked(bool $checked = true)
    {
        $this->checked = $checked;
        return $this;
    }

    /**
     * 设置 indeterminate 状态，只负责样式控制
     * @param bool $indeterminate
     * @return $this
     */
    public function setIndeterminate(bool $indeterminate = true)
    {
        $this->indeterminate = $indeterminate;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

}
