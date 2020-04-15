<?php

namespace SmallRuralDog\Admin\Components;

class IconChoose extends GridComponent
{
    protected $componentName = "IconChoose";

    public static function make($value = null)
    {
        return new IconChoose($value);
    }

}
