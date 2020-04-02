<?php


namespace SmallRuralDog\Admin\Components\Grid;


use SmallRuralDog\Admin\Components\Component;

class Boole extends Component
{
    protected $componentName = "Boole";


    public static function make($value = null)
    {
        return new Boole($value);
    }

}
