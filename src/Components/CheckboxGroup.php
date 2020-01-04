<?php


namespace SmallRuralDog\Admin\Components;


class CheckboxGroup extends Component
{
    public $componentName = "CheckboxGroup";

    /**
     * @var string
     */
    public $size;
    public $disabled = false;
    /**
     * @var int
     */
    public $min;
    /**
     * @var int
     */
    public $max;
    public $textColor = "#ffffff";
    public $fill = "#409EFF";

    /**
     * @var Checkbox[]
     */
    public $options = [];

    static public function make($value = null, $options = [])
    {
        return (new CheckboxGroup($value))->setOptions($options);
    }

    /**
     * 多选框组尺寸，仅对按钮形式的 Checkbox 或带有边框的 Checkbox 有效
     * @param string $size
     * @return $this
     */
    public function setSize(string $size)
    {
        $this->size = $size;
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
     * 可被勾选的 checkbox 的最小数量
     * @param int $min
     * @return $this
     */
    public function setMin(int $min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * 可被勾选的 checkbox 的最大数量
     * @param int $max
     * @return $this
     */
    public function setMax(int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * 按钮形式的 Checkbox 激活时的文本颜色
     * @param string $textColor
     * @return $this
     */
    public function setTextColor(string $textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * 按钮形式的 Checkbox 激活时的填充色和边框色
     * @param string $fill
     * @return $this
     */
    public function setFill(string $fill)
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * @param Checkbox[] $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }


}
