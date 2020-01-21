<?php


namespace SmallRuralDog\Admin\Components;


use Carbon\Traits\Date;

class DatePicker extends Component
{
    protected $componentName = "DatePicker";

    protected $readonly = false;
    protected $disabled = false;
    protected $editable = true;
    protected $clearable = true;
    protected $size;
    protected $placeholder;
    protected $startPlaceholder;
    protected $endPlaceholder;
    protected $type = "date";
    protected $format = "yyyy-MM-dd";
    protected $align = "left";
    protected $popperClass;
    protected $pickerOptions;
    protected $rangeSeparator = "-";
    protected $defaultValue;
    protected $defaultTime;
    protected $valueFormat = "yyyy-MM-dd";
    protected $unlinkPanels = false;
    protected $prefixIcon = "el-icon-date";
    protected $clearIcon = "el-icon-circle-close";
    protected $validateEvent = true;

    static public function make($value = null, $type = "date")
    {
        return (new DatePicker($value))->type($type);
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
    public function disabled($disabled)
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
    public function clearable($clearable)
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
     * 范围选择时结束日期的占位内容
     * @param string $endPlaceholder
     * @return $this
     */
    public function endPlaceholder($endPlaceholder)
    {
        $this->endPlaceholder = $endPlaceholder;
        return $this;
    }

    /**
     * 显示类型
     * year/month/date/dates/week/datetime/datetimerange/daterange/monthrange
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 显示在输入框中的格式
     * @param string $format
     * @return $this
     */
    public function format($format)
    {
        $this->format = $format;
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
     * DatePicker 下拉框的类名
     * @param string $popperClass
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
     * 可选，选择器打开时默认显示的时间
     * @param Date $defaultValue
     * @return $this
     */
    public function defaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * 范围选择时选中日期所使用的当日内具体时刻
     * @param string[] $defaultTime
     * @return $this
     */
    public function defaultTime($defaultTime)
    {
        $this->defaultTime = $defaultTime;
        return $this;
    }

    /**
     * 可选，绑定值的格式。不指定则绑定值为 Date 对象
     * @param mixed $valueFormat
     * @return $this
     */
    public function valueFormat($valueFormat)
    {
        $this->valueFormat = $valueFormat;
        return $this;
    }

    /**
     * 在范围选择器里取消两个日期面板之间的联动
     * @param bool $unlinkPanels
     * @return $this
     */
    public function unlinkPanels($unlinkPanels = true)
    {
        $this->unlinkPanels = $unlinkPanels;
        return $this;
    }

    /**
     * 自定义头部图标的类名
     * @param string $prefixIcon
     * @return $this
     */
    public function prefixIcon($prefixIcon)
    {
        $this->prefixIcon = $prefixIcon;
        return $this;
    }

    /**
     * 自定义清空图标的类名
     * @param string $clearIcon
     * @return $this
     */
    public function clearIcon($clearIcon)
    {
        $this->clearIcon = $clearIcon;
        return $this;
    }

    /**
     * 输入时是否触发表单的校验
     * @param bool $validateEvent
     * @return $this
     */
    public function validateEvent($validateEvent = true)
    {
        $this->validateEvent = $validateEvent;
        return $this;
    }


}
