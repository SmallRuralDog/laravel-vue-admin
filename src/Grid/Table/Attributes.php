<?php

namespace SmallRuralDog\Admin\Grid\Table;

class Attributes
{

    public $height;

    public $maxHeight;

    /**
     * @var bool
     */
    public $stripe = true;

    /**
     * @var bool
     */
    public $border = false;

    /**
     * @var string
     */
    public $size = "medium";

    /**
     * @var bool
     */
    public $fit = true;

    /**
     * @var bool
     */
    public $showHeader = true;

    /**
     * @var bool
     */
    public $highlightCurrentRow;


    public $emptyText;


    public $tooltipEffect;

    public $rowKey = 'id';

}
