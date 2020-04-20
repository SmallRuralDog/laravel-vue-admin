<?php


namespace SmallRuralDog\Admin\Components\Widgets;


use SmallRuralDog\Admin\Components\Attrs\Button;
use SmallRuralDog\Admin\Components\Component;

class DialogButton extends Component
{

    use Button;

    protected $componentName = 'DialogButton';


    public static function make()
    {
        return new DialogButton();
    }

}
