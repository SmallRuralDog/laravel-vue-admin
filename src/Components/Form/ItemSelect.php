<?php
namespace SmallRuralDog\Admin\Components\Form;

use SmallRuralDog\Admin\Components\Component;

class ItemSelect extends Component
{
    protected $componentName = "ItemSelect";

    public static function make()
    {
        return new ItemSelect();
    }

}
