<?php

namespace SmallRuralDog\Admin\Grid\Table;

trait TraitAttributes
{

    /**
     * @var Attributes
     */
    protected $attributes;

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


}
