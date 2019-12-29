<?php


namespace SmallRuralDog\Admin\Grid\Column;


use SmallRuralDog\Admin\Grid\Column;

trait HasConfig
{

    /**
     * 列类型，可选值为 index、selection、expand、html
     * @param mixed $type
     * @return Column
     */
    public function setType($type)
    {
        $this->config->type = $type;
        return $this;
    }

    /**
     * 列宽
     * @param mixed $width
     * @return Column
     */
    public function setWidth($width)
    {
        $this->config->width = $width;

        return $this;
    }

    /**
     * 最小列宽
     * @param int $minWidth
     * @return Column
     */
    public function setMinWidth($minWidth)
    {
        $this->config->minWidth = $minWidth;
        return $this;
    }

    /**
     * 最大列宽
     * @param int $maxWidth
     * @return Column
     */
    public function setMaxWidth($maxWidth)
    {
        $this->config->maxWidth = $maxWidth;
        return $this;
    }

    /**
     * 对齐方式，可选值为 left 左对齐、right 右对齐和 center 居中对齐
     * @param string $align
     * @return Column
     */
    public function setAlign(string $align)
    {
        $this->config->align = $align;
        return $this;
    }

    /**
     * 列的样式名称
     * @param string $className
     * @return Column
     */
    public function setClassName($className)
    {
        $this->config->className = $className;
        return $this;
    }

    /**
     * 列是否固定在左侧或者右侧，可选值为 left 左侧和 right 右侧
     * @param string $fixed
     * @return Column
     */
    public function setFixed($fixed)
    {
        $this->config->fixed = $fixed;
        return $this;
    }

    /**
     * 开启后，文本将不换行，超出部分显示为省略号
     * @param bool $ellipsis
     * @return Column
     */
    public function setEllipsis(bool $ellipsis)
    {
        $this->config->ellipsis = $ellipsis;
        return $this;
    }

    /**
     * 开启后，文本将不换行，超出部分显示为省略号，并用 Tooltip 组件显示完整内容
     * @param bool $tooltip
     * @return Column
     */
    private function setTooltip(bool $tooltip)
    {
        $this->config->tooltip = $tooltip;

        return $this;
    }

}
