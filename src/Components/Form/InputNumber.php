<?php


namespace SmallRuralDog\Admin\Components\Form;

use SmallRuralDog\Admin\Components\Component;

/**
 * Class InputNumber
 * @package SmallRuralDog\Admin\Components
 */
class InputNumber extends Component
{
    protected $componentName = 'InputNumber';

    /**
     * @var int
     */
    protected $min = -999999999;
    /**
     * @var int
     */
    protected $max = 999999999;

    /**
     * @var int
     */
    protected $step = 1;
    protected $stepStrictly = false;
    /**
     * @var int
     */
    public $precision;
    /**
     * @var string
     */
    protected $size;
    protected $disabled = false;
    protected $controls = true;
    protected $controlsPosition = 'right';
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var string
     */
    protected $placeholder;

    static public function make($value = 0)
    {
        return new InputNumber($value);
    }

    /**
     * 设置计数器允许的最小值
     * @param int $min
     * @return $this
     */
    public function min(int $min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * 设置计数器允许的最大值
     * @param int $max
     * @return $this
     */
    public function max(int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * 计数器步长
     * @param int $step
     * @return $this
     */
    public function step(int $step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * 是否只能输入 step 的倍数
     * @param bool $stepStrictly
     * @return $this
     */
    public function stepStrictly(bool $stepStrictly = true)
    {
        $this->stepStrictly = $stepStrictly;
        return $this;
    }

    /**
     * 数值精度
     * @param int $precision
     * @return $this
     */
    public function precision(int $precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * 计数器尺寸
     * large, small
     * @param string $size
     * @return $this
     */
    public function size(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 是否禁用计数器
     * @param bool $disabled
     * @return $this
     */
    public function disabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 是否使用控制按钮
     * @param bool $controls
     * @return $this
     */
    public function controls(bool $controls = true)
    {
        $this->controls = $controls;
        return $this;
    }

    /**
     * 控制按钮位置
     * @param string $controlsPosition
     * @return $this
     */
    public function controlsPosition(string $controlsPosition)
    {
        $this->controlsPosition = $controlsPosition;
        return $this;
    }

    /**
     * 原生属性
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 输入框关联的label文字
     * @param string $label
     * @return $this
     */
    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * 输入框默认 placeholder
     * @param string $placeholder
     * @return $this
     */
    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }


}
