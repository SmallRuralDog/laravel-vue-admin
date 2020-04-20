<?php


namespace SmallRuralDog\Admin\Components\Grid;


use SmallRuralDog\Admin\Components\GridComponent;

class Icon extends GridComponent
{
    protected $componentName = "Icon";

    static public function make($value = null)
    {
        return new Icon($value);
    }

}
