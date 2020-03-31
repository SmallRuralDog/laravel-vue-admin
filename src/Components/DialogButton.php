<?php


namespace SmallRuralDog\Admin\Components;


use SmallRuralDog\Admin\Components\Attrs\Button;

class DialogButton extends Component
{

    use Button;

    protected $componentName = 'DialogButton';


    public static function make()
    {
        return new DialogButton();
    }

}
