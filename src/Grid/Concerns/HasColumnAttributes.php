<?php


namespace SmallRuralDog\Admin\Grid\Concerns;


use SmallRuralDog\Admin\Components\Link;
use SmallRuralDog\Admin\Components\Tag;

trait HasColumnAttributes
{
    /**
     *
     * @var Attributes
     */
    protected $attributes;

    /**
     * 对应列的类型
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->attributes->type = $type;
        return $this;
    }



    /**
     * column 的 key
     * @param string $columnKey
     * @return $this
     */
    public function columnKey($columnKey)
    {
        $this->attributes->columnKey = $columnKey;
        return $this;
    }

    /**
     * 显示的标题
     * @param string $label
     * @return $this
     */
    private function label(string $label)
    {
        $this->attributes->label = $label;

        return $this;
    }

    /**
     * 对应列内容的字段名
     * @param string $prop
     * @return $this
     */
    public function prop(string $prop)
    {
        $this->attributes->prop = $prop;

        return $this;
    }

    /**
     * 对应列的宽度
     * @param string $width
     * @return $this
     */
    public function width(string $width)
    {
        $this->attributes->width = $width;
        return $this;
    }

    /**
     * 对应列的最小宽度，与 width 的区别是 width 是固定的，min-width 会把剩余宽度按比例分配给设置了 min-width 的列
     * @param string $minWidth
     * @return $this
     */
    public function minWidth(string $minWidth)
    {
        $this->attributes->minWidth = $minWidth;
        return $this;
    }

    /**
     * 列是否固定在左侧或者右侧，true 表示固定在左侧
     * true, left, right
     * @param bool|string $fixed
     * @return $this
     */
    public function fixed($fixed = true)
    {
        $this->attributes->fixed = $fixed;
        return $this;
    }

    /**
     * 当内容过长被隐藏时显示 tooltip
     * @param bool $showOverflowTooltip
     * @return $this
     */
    public function showOverflowTooltip($showOverflowTooltip = true)
    {
        $this->attributes->showOverflowTooltip = $showOverflowTooltip;
        return $this;
    }

    /**
     * 对齐方式 left/center/right
     * @param string $align
     * @return $this
     */
    public function align(string $align)
    {
        $this->attributes->align = $align;
        return $this;
    }

    /**
     * 表头对齐方式，若不设置该项，则使用表格的对齐方式 left/center/right
     * @param string $headerAlign
     * @return $this
     */
    public function headerAlign($headerAlign)
    {
        $this->attributes->headerAlign = $headerAlign;
        return $this;
    }

    /**
     * 列的 className
     * @param string $className
     * @return $this
     */
    public function className($className)
    {
        $this->attributes->className = $className;
        return $this;
    }

    /**
     * 当前列标题的自定义类名
     * @param string $labelClassName
     * @return $this
     */
    public function labelClassName($labelClassName)
    {
        $this->attributes->labelClassName = $labelClassName;
        return $this;
    }

    /**
     * 表头提示内容
     * @param string $help
     * @return $this
     */
    public function help($help)
    {
        $this->attributes->help = $help;
        return $this;
    }

    /**
     * 对应列是否可以排序，如果设置为 'custom'，则代表用户希望远程排序，需要监听 Table 的 sort-change 事件
     * true, false, 'custom'
     * @param string $sortable
     * @return $this
     */
    public function sortable($sortable = 'custom')
    {
        $this->attributes->sortable = $sortable == 'custom';
        return $this;
    }


    /**
     * 暂不支持
     * 数据过滤的选项，数组格式，数组中的元素需要有 text 和 value 属性。
     * @param array $filters
     * @return $this
     */
    public function filters(array $filters)
    {
        $this->attributes->filters = $filters;
        return $this;
    }

    /**
     * 过滤弹出框的定位 与 Tooltip 的 placement 属性相同
     * @param $filterPlacement
     * @return $this
     */
    public function filterPlacement($filterPlacement)
    {
        $this->attributes->filterPlacement = $filterPlacement;
        return $this;
    }


    /**
     * 数据过滤的选项是否多选
     * @param bool $filterMultiple
     * @return $this
     */
    public function filterMultiple(bool $filterMultiple)
    {
        $this->attributes->filterMultiple = $filterMultiple;
        return $this;
    }


    /**
     * @param Tag|Link $displayComponentAttrs
     * @return $this
     */
    private function displayComponentAttrs($displayComponentAttrs)
    {
        $this->attributes->displayComponentAttrs = $displayComponentAttrs;
        return $this;
    }
}
