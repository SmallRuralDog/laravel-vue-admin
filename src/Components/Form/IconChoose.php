<?php

namespace SmallRuralDog\Admin\Components\Form;

use SmallRuralDog\Admin\Components\Component;

class IconChoose extends Component
{
    protected $componentName = "IconChoose";

    public static function make($value = null)
    {
        return new IconChoose($value);
    }

}
