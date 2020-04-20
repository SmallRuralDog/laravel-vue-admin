<?php


namespace SmallRuralDog\Admin\Components;


use SmallRuralDog\Admin\Components\Attrs\Button;

/**
 * @deprecated
 * Class DialogButton
 * @package SmallRuralDog\Admin\Components
 */
class DialogButton extends Component
{

    use Button;

    protected $componentName = 'DialogButton';


    public static function make()
    {
        return new DialogButton();
    }

}
