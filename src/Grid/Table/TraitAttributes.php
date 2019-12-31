<?php

namespace SmallRuralDog\Admin\Grid\Table;

trait TraitAttributes
{

    /**
     * @var Attributes
     */
    protected $attributes;


    /**
     * Table 的高度，默认为自动高度。如果 height 为 number 类型，单位 px；如果 height 为 string 类型，则这个高度会设置为 Table 的 style.height 的值，Table 的高度会受控于外部样式。
     * @param string|int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->attributes->height = $height;
        return $this;
    }


    /**
     * Table 的最大高度。合法的值为数字或者单位为 px 的高度。
     * @param string|int $maxHeight
     * @return $this
     */
    public function setMaxHeight($maxHeight)
    {
        $this->attributes->maxHeight = $maxHeight;
        return $this;
    }

    /**
     * 是否为斑马纹 table
     * @param bool $stripe
     * @return $this
     */
    public function setStripe(bool $stripe)
    {
        $this->attributes->stripe = $stripe;
        return $this;
    }

    /**
     * 是否带有纵向边框
     * @param bool $border
     * @return $this
     */
    public function setBorder(bool $border)
    {
        $this->attributes->border = $border;
        return $this;
    }

    /**
     * Table 的尺寸
     * medium / small / mini
     * @param string $size
     * @return $this
     */
    public function setSize(string $size)
    {
        $this->attributes->size = $size;
        return $this;
    }


    /**
     * 列的宽度是否自撑开
     * @param bool $fit
     * @return $this
     */
    public function setFit(bool $fit)
    {
        $this->attributes->fit = $fit;
        return $this;
    }


    /**
     * 是否显示表头
     * @param bool $showHeader
     * @return $this
     */
    public function setShowHeader(bool $showHeader)
    {
        $this->attributes->showHeader = $showHeader;
        return $this;
    }


    /**
     * 是否要高亮当前行
     * @param bool $highlightCurrentRow
     * @return $this
     */
    public function setHighlightCurrentRow(bool $highlightCurrentRow)
    {
        $this->attributes->highlightCurrentRow = $highlightCurrentRow;
        return $this;
    }

    /**
     * 空数据时显示的文本内容
     * @param string $emptyText
     * @return $this
     */
    public function setEmptyText($emptyText)
    {
        $this->attributes->emptyText = $emptyText;
        return $this;
    }

    /**
     * tooltip effect 属性
     * dark/light
     * @param string $tooltipEffect
     * @return $this
     */
    public function setTooltipEffect($tooltipEffect)
    {
        $this->attributes->tooltipEffect = $tooltipEffect;
        return $this;
    }

}
