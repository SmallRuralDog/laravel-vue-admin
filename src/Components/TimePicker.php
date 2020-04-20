<?php


namespace SmallRuralDog\Admin\Components;

/**
 * Class TimePicker
 * @package SmallRuralDog\Admin\Components
 * @deprecated
 */
class TimePicker extends Component
{
    protected $componentName = "TimePicker";

    protected $readonly = false;
    protected $disabled = false;
    protected $editable = true;
    protected $clearable = true;
    protected $size;
    protected $placeholder;
    protected $startPlaceholder;
    protected $endPlaceholder;
    protected $isRange = false;
    protected $arrowControl = false;
    protected $align = "left";
    protected $popperClass;
    protected $pickerOptions;
    protected $rangeSeparator = '-';
    protected $valueFormat = "HH:mm:ss";
    protected $defaultValue;
    protected $name;
    protected $prefixIcon;
    protected $clearIcon;
    protected $selectableRange;
    protected $format = "HH:mm:ss";
    protected $type = "select";


    static public function make($value = '', $type = "select")
    {
        return (new TimePicker($value))->type($type);
    }

    /**
     * 完全只读
     * @param bool $readonly
     * @return $this
     */
    public function readonly($readonly = true)
    {
        $this->readonly = $readonly;
        return $this;
    }

    /**
     * 禁用
     * @param bool $disabled
     * @return $this
     */
    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 文本框可输入
     * @param bool $editable
     * @return $this
     */
    public function editable($editable = true)
    {
        $this->editable = $editable;
        return $this;
    }

    /**
     * 是否显示清除按钮
     * @param bool $clearable
     * @return $this
     */
    public function clearable($clearable = true)
    {
        $this->clearable = $clearable;
        return $this;
    }

    /**
     * 输入框尺寸
     * @param string $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 非范围选择时的占位内容
     * @param string $placeholder
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * 范围选择时开始日期的占位内容
     * @param string $startPlaceholder
     * @return $this
     */
    public function startPlaceholder($startPlaceholder)
    {
        $this->startPlaceholder = $startPlaceholder;
        return $this;
    }

    /**
     * 范围选择时开始日期的占位内容
     * @param string $endPlaceholder
     * @return $this
     */
    public function endPlaceholder($endPlaceholder)
    {
        $this->endPlaceholder = $endPlaceholder;
        return $this;
    }

    /**
     * 是否为时间范围选择，仅对<el-time-picker>有效
     * @param bool $isRange
     * @return $this
     */
    public function isRange($isRange = true)
    {
        $this->isRange = $isRange;
        return $this;
    }

    /**
     * 是否使用箭头进行时间选择，仅对<el-time-picker>有效
     * @param bool $arrowControl
     * @return $this
     */
    public function arrowControl($arrowControl = true)
    {
        $this->arrowControl = $arrowControl;
        return $this;
    }

    /**
     * 对齐方式
     * @param string $align
     * @return $this
     */
    public function align($align)
    {
        $this->align = $align;
        return $this;
    }

    /**
     * TimePicker 下拉框的类名
     * @param mixed $popperClass
     * @return $this
     */
    public function popperClass($popperClass)
    {
        $this->popperClass = $popperClass;
        return $this;
    }

    /**
     * 当前时间日期选择器特有的选项参考下表
     * @param array $pickerOptions
     * @return $this
     */
    public function pickerOptions($pickerOptions)
    {
        $this->pickerOptions = $pickerOptions;
        return $this;
    }

    /**
     * 选择范围时的分隔符
     * @param string $rangeSeparator
     * @return $this
     */
    public function rangeSeparator($rangeSeparator)
    {
        $this->rangeSeparator = $rangeSeparator;
        return $this;
    }

    /**
     * 可选，仅TimePicker时可用，绑定值的格式。不指定则绑定值为 Date 对象
     * @param string $valueFormat
     * @return $this
     */
    public function valueFormat($valueFormat)
    {
        $this->valueFormat = $valueFormat;
        return $this;
    }

    /**
     * 可选，选择器打开时默认显示的时间
     * @param string $defaultValue
     * @return $this
     */
    public function defaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * 原生属性
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 自定义头部图标的类名
     * @param mixed $prefixIcon
     * @return $this
     */
    public function prefixIcon($prefixIcon)
    {
        $this->prefixIcon = $prefixIcon;
        return $this;
    }

    /**
     * 自定义清空图标的类名
     * @param mixed $clearIcon
     * @return $this
     */
    public function clearIcon($clearIcon)
    {
        $this->clearIcon = $clearIcon;
        return $this;
    }

    /**
     * 可选时间段，例如'18:30:00 - 20:30:00'或者传入数组['09:30:00 - 12:00:00', '14:30:00 - 18:30:00']
     * @param mixed $selectableRange
     * @return $this
     */
    public function selectableRange($selectableRange)
    {
        $this->selectableRange = $selectableRange;
        return $this;
    }

    /**
     * 时间格式化(TimePicker)
     * @param string $format
     * @return $this
     */
    public function format($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * 组件类型  select / picker
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }



}
