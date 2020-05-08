<?php

namespace SmallRuralDog\Admin\Grid\Concerns;

use SmallRuralDog\Admin\Components\Widgets\Dialog;

trait HasDialog
{
    protected $dialog;

    public function dialog(\Closure $closure)
    {
        $this->dialog = new Dialog();
        call_user_func($closure, $this->dialog);
        return $this;
    }

}
