<?php


namespace SmallRuralDog\Admin\Components;


class Radio extends Component
{
    public $componentName = "Radio";

    /**
     * @var string
     */
    public $label;
    public $disabled = false;
    public $border = false;
    /**
     * @var string
     */
    public $size;
    /**
     * 原生 name 属性
     * @var string
     */
    public $name;

    public $title;

    static public function make($value, $title)
    {
        return (new Radio($value))->setLabel($value)->setTitle($title);
    }

    /**
     * Radio 的 value
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * 是否禁用
     * @param bool $disabled
     * @return $this
     */
    public function setDisabled(bool $disabled)
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
     * Radio 的尺寸，仅在 border 为真时有效
     * @param string $size
     * @return $this
     */
    public function setSize(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 原生 name 属性
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

}
