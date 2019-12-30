<?php


namespace SmallRuralDog\Admin\Grid\Column;


trait TraitAttributes
{
    /**
     *
     * @var Attributes
     */
    protected $attributes;

    /**
     * 显示的标题
     * @param string $label
     * @return TraitAttributes
     */
    private function setLabel(string $label)
    {
        $this->attributes->label = $label;

        return $this;
    }

    /**
     * 对应列内容的字段名
     * @param string $prop
     * @return TraitAttributes
     */
    public function setProp(string $prop)
    {
        $this->attributes->prop = $prop;

        return $this;
    }

    /**
     * 对应列的宽度
     * @param string $width
     * @return TraitAttributes
     */
    public function setWidth(string $width)
    {
        $this->attributes->width = $width;
        return $this;
    }

    /**
     * 对应列的最小宽度，与 width 的区别是 width 是固定的，min-width 会把剩余宽度按比例分配给设置了 min-width 的列
     * @param string $minWidth
     * @return TraitAttributes
     */
    public function setMinWidth(string $minWidth)
    {
        $this->attributes->minWidth = $minWidth;
        return $this;
    }

    /**
     * 列是否固定在左侧或者右侧，true 表示固定在左侧
     * true, left, right
     * @param bool|string $fixed
     * @return TraitAttributes
     */
    public function setFixed($fixed)
    {
        $this->attributes->fixed = $fixed;
        return $this;
    }

    /**
     * 当内容过长被隐藏时显示 tooltip
     * @param bool $showOverflowTooltip
     * @return TraitAttributes
     */
    public function setShowOverflowTooltip(bool $showOverflowTooltip)
    {
        $this->attributes->showOverflowTooltip = $showOverflowTooltip;
        return $this;
    }

    /**
     * 对齐方式 left/center/right
     * @param string $align
     * @return TraitAttributes
     */
    public function setAlign(string $align)
    {
        $this->attributes->align = $align;
        return $this;
    }

    /**
     * 表头对齐方式，若不设置该项，则使用表格的对齐方式 left/center/right
     * @param string $headerAlign
     * @return TraitAttributes
     */
    public function setHeaderAlign(string $headerAlign)
    {
        $this->attributes->headerAlign = $headerAlign;
        return $this;
    }

    /**
     * 列的 className
     * @param string $className
     * @return TraitAttributes
     */
    public function setClassName(string $className)
    {
        $this->attributes->className = $className;
        return $this;
    }

    /**
     * 当前列标题的自定义类名
     * @param string $labelClassName
     * @return TraitAttributes
     */
    public function setLabelClassName(string $labelClassName)
    {
        $this->attributes->labelClassName = $labelClassName;
        return $this;
    }

    /**
     * 表头提示内容
     * @param string $help
     * @return $this
     */
    public function setHelp(string $help){
        $this->attributes->help = $help;
        return $this;
    }

    /**
     * 对应列是否可以排序，如果设置为 'custom'，则代表用户希望远程排序，需要监听 Table 的 sort-change 事件
     * true, false, 'custom'
     * @param bool $sortable
     * @return $this
     */
    public function setSortable(bool $sortable=true){
        $this->attributes->sortable = $sortable;
        return $this;
    }
}
