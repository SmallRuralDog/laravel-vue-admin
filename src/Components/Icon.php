<?php


namespace SmallRuralDog\Admin\Components;

/**
 * @deprecated
 * Class Icon
 * @package SmallRuralDog\Admin\Components
 */
class Icon extends GridComponent
{
    protected $componentName = "Icon";

    static public function make($value = null)
    {
        return new Icon($value);
    }

}
