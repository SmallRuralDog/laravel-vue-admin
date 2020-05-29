<?php


namespace SmallRuralDog\Admin\Grid\Tools;


use SmallRuralDog\Admin\Actions\BaseAction;
use SmallRuralDog\Admin\Components\Attrs\Button;

class CreateButton extends BaseAction
{
    use Button;

    protected $componentName = "GridCreateButton";

    protected $isDialog = false;

    /**
     * @param bool $isDialog
     * @return CreateButton
     */
    public function isDialog(bool $isDialog)
    {
        $this->isDialog = $isDialog;
        return $this;
    }





}
