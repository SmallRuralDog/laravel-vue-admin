<?php


namespace SmallRuralDog\Admin\Components\Widgets;


use SmallRuralDog\Admin\Components\Attrs\ElDialog;
use SmallRuralDog\Admin\Components\Component;

class Dialog extends Component
{
    use ElDialog;

    protected $componentName = "Dialog";


    public static function make()
    {
        return new Dialog();
    }

}
