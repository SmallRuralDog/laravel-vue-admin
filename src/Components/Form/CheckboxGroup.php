<?php


namespace SmallRuralDog\Admin\Components\Form;


use SmallRuralDog\Admin\Components\Component;

class CheckboxGroup extends Component
{
    protected $componentName = "CheckboxGroup";

    /**
     * @var string
     */
    protected $size;
    protected $disabled = false;
    /**
     * @var int
     */
    public $min = 0;
    /**
     * @var int
     */
    protected $max;
    protected $textColor = "#ffffff";
    protected $fill = "#409EFF";

    /**
     * @var Checkbox[]
     */
    protected $options = [];

    static public function make($value = null, $options = [])
    {
        return (new CheckboxGroup($value))->options($options);
    }

    /**
     * 多选框组尺寸，仅对按钮形式的 Checkbox 或带有边框的 Checkbox 有效
     * @param string $size
     * @return $this
     */
    public function size(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 是否禁用
     * @param bool $disabled
     * @return $this
     */
    public function disabled(bool $disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 可被勾选的 checkbox 的最小数量
     * @param int $min
     * @return $this
     */
    public function min(int $min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * 可被勾选的 checkbox 的最大数量
     * @param int $max
     * @return $this
     */
    public function max(int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * 按钮形式的 Checkbox 激活时的文本颜色
     * @param string $textColor
     * @return $this
     */
    public function textColor(string $textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * 按钮形式的 Checkbox 激活时的填充色和边框色
     * @param string $fill
     * @return $this
     */
    public function fill(string $fill)
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * @param Checkbox[] $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = $options;
        if (!$this->max) {
            $this->max = count($options);
        }
        return $this;
    }


}
