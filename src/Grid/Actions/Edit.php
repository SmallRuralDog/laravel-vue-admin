<?php

namespace SmallRuralDog\Admin\Grid\Actions;

use SmallRuralDog\Admin\Actions\RowAction;

class Edit extends RowAction
{
    public $actionKey = "edit";
    public $name = "编辑";


    public function __construct()
    {
        $this->vueRoute = $this->getRoutePath() . '/' . $this->getKey() . '/edit';
    }


}
