<?php


namespace SmallRuralDog\Admin\Grid;


use SmallRuralDog\Admin\Grid\Concerns\HasActions;
use SmallRuralDog\Admin\Traits\AdminJsonBuilder;

class Actions extends AdminJsonBuilder
{
    use HasActions;
}
