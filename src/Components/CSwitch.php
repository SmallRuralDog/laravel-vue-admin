<?php


namespace SmallRuralDog\Admin\Components;

/**
 * @deprecated
 * Class CSwitch
 * @package SmallRuralDog\Admin\Components
 */
class CSwitch extends Component
{
    protected $componentName = "CSwitch";

    protected $disabled = false;
    protected $width = 40;
    protected $activeIconClass;
    protected $inactiveIconClass;
    protected $activeText;
    protected $inactiveText;
    protected $activeValue = true;
    protected $inactiveValue = false;
    protected $activeColor = "#409EFF";
    protected $inactiveColor = "#C0CCDA";
    protected $name = "#C0CCDA";
    protected $validateEvent = true;

    static public function make($value = false)
    {
        return new CSwitch($value);
    }

    public function getValue($value)
    {
        return boolval($value);
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
     * switch 的宽度（像素）
     * @param int $width
     * @return $this
     */
    public function width(int $width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * switch 打开时所显示图标的类名，设置此项会忽略 active-text
     * @param string $activeIconClass
     * @return $this
     */
    public function activeIconClass($activeIconClass)
    {
        $this->activeIconClass = $activeIconClass;
        return $this;
    }

    /**
     * switch 关闭时所显示图标的类名，设置此项会忽略 inactive-text
     * @param string $inactiveIconClass
     * @return $this
     */
    public function inactiveIconClass($inactiveIconClass)
    {
        $this->inactiveIconClass = $inactiveIconClass;
        return $this;
    }

    /**
     * switch 打开时的文字描述
     * @param string $activeText
     * @return $this
     */
    public function activeText($activeText)
    {
        $this->activeText = $activeText;
        return $this;
    }

    /**
     * switch 关闭时的文字描述
     * @param string $inactiveText
     * @return $this
     */
    public function inactiveText($inactiveText)
    {
        $this->inactiveText = $inactiveText;
        return $this;
    }

    /**
     * switch 打开时的值
     * @param bool $activeValue
     * @return $this
     */
    public function activeValue($activeValue)
    {
        $this->activeValue = $activeValue;
        return $this;
    }

    /**
     * switch 关闭时的值
     * @param bool $inactiveValue
     * @return $this
     */
    public function inactiveValue($inactiveValue)
    {
        $this->inactiveValue = $inactiveValue;
        return $this;
    }

    /**
     * switch 打开时的背景色
     * @param string $activeColor
     * @return $this
     */
    public function activeColor($activeColor)
    {
        $this->activeColor = $activeColor;
        return $this;
    }

    /**
     * switch 关闭时的背景色
     * @param string $inactiveColor
     * @return $this
     */
    public function inactiveColor($inactiveColor)
    {
        $this->inactiveColor = $inactiveColor;
        return $this;
    }

    /**
     * switch 对应的 name 属性
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 改变 switch 状态时是否触发表单的校验
     * @param bool $validateEvent
     * @return $this
     */
    public function validateEvent($validateEvent = true)
    {
        $this->validateEvent = $validateEvent;
        return $this;
    }


}
