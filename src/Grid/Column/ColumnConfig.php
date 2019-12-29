<?php


namespace SmallRuralDog\Admin\Grid\Column;


class ColumnConfig
{
    /**
     * 列类型，可选值为 index、selection、expand、html
     * @var
     */
    public $type;
    /**
     * 列头显示文字
     * @var
     */
    public $title;

    public $key;

    public $width;
    public $minWidth;
    public $maxWidth;
    public $align = "left";
    public $className;
    public $fixed;
    public $ellipsis = false;
    public $tooltip = false;





}
