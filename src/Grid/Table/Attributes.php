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
    public $size = "small";

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


    protected $hideCreateButton = false;

    public $draggable = false;
    public $draggableUrl;

    public $defaultExpandAll = false;

    public $treeProps = ['hasChildren' => 'hasChildren', 'children' => 'children'];


    public $hideActions=false;
    public $actionWidth;
    public $actionLabel = "操作";
    public $actionFixed;
    public $actionAlign = "left";

    public $selection = false;

    public $dataVuex = false;

}
