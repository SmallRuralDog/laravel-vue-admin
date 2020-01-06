<?php


namespace SmallRuralDog\Admin\Components;


class Slider extends Component
{
    protected $componentName = "Slider";

    protected $min = 0;
    protected $max = 100;
    protected $disabled = false;
    protected $step = 1;
    protected $showInput = false;
    protected $showInputControls = true;
    protected $inputSize = "small";
    protected $showStops = false;
    protected $showTooltip = true;
    protected $range = false;
    protected $vertical = false;
    protected $height;
    protected $label;

    protected $tooltipClass;

    static public function make($value = null)
    {
        return new Slider($value);
    }

    /**
     *最小值
     * @param int $min
     * @return $this
     */
    public function min($min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * 最大值
     * @param int $max
     * @return $this
     */
    public function max($max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * 是否禁用
     * @param bool $disabled
     * @return $this
     */
    public function disabled($disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 步长
     * @param int $step
     * @return $this
     */
    public function step($step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * 是否显示输入框，仅在非范围选择时有效
     * @param bool $showInput
     * @return $this
     */
    public function showInput($showInput = true)
    {
        $this->showInput = $showInput;
        return $this;
    }

    /**
     * 在显示输入框的情况下，是否显示输入框的控制按钮
     * @param bool $showInputControls
     * @return $this
     */
    public function showInputControls($showInputControls = true)
    {
        $this->showInputControls = $showInputControls;
        return $this;
    }

    /**
     * 输入框的尺寸
     * large / medium / small / mini
     * @param string $inputSize
     * @return $this
     */
    public function inputSize($inputSize)
    {
        $this->inputSize = $inputSize;
        return $this;
    }

    /**
     * 是否显示间断点
     * @param bool $showStops
     * @return $this
     */
    public function showStops($showStops = true)
    {
        $this->showStops = $showStops;
        return $this;
    }

    /**
     * 是否显示 tooltip
     * @param bool $showTooltip
     * @return $this
     */
    public function showTooltip($showTooltip = true)
    {
        $this->showTooltip = $showTooltip;
        return $this;
    }

    /**
     * 是否为范围选择
     * @param bool $range
     * @return $this
     */
    public function range($range = true)
    {
        $this->range = $range;
        return $this;
    }

    /**
     * 是否竖向模式
     * @param bool $vertical
     * @param int $height
     * @return $this
     */
    public function vertical($vertical = true, $height = 100)
    {
        $this->vertical = $vertical;
        $this->height = $height;
        return $this;
    }

    /**
     * Slider 高度，竖向模式时必填
     * @param mixed $height
     * @return $this
     */
    public function height($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * 屏幕阅读器标签
     * @param string $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * tooltip 的自定义类名
     * @param string $tooltipClass
     * @return $this
     */
    public function tooltipClass($tooltipClass)
    {
        $this->tooltipClass = $tooltipClass;
        return $this;
    }


}
