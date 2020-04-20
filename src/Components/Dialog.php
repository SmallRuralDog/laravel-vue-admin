<?php


namespace SmallRuralDog\Admin\Components;


use SmallRuralDog\Admin\Components\Attrs\ElDialog;

/**
 * @deprecated
 * Class Dialog
 * @package SmallRuralDog\Admin\Components
 */
class Dialog extends Component
{
    use ElDialog;

    protected $componentName = "Dialog";


    public static function make()
    {
        return new Dialog();
    }

}
