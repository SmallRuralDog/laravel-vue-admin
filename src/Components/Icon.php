<?php


namespace SmallRuralDog\Admin\Components;


class Icon extends GridComponent
{
    protected $componentName = "Icon";

    static public function make($value = null)
    {
        return new Icon($value);
    }

}
