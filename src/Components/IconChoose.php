<?php

namespace SmallRuralDog\Admin\Components;
/**
 * @deprecated
 * Class IconChoose
 * @package SmallRuralDog\Admin\Components
 */
class IconChoose extends GridComponent
{
    protected $componentName = "IconChoose";

    public static function make($value = null)
    {
        return new IconChoose($value);
    }

}
