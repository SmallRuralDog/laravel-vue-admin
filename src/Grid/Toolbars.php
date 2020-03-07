<?php


namespace SmallRuralDog\Admin\Grid;


use SmallRuralDog\Admin\Grid\Tools\CreateButton;
use SmallRuralDog\Admin\Traits\AdminJsonBuilder;

class Toolbars extends AdminJsonBuilder
{
    private $left;
    private $addLeft = [];
    private $right;
    private $addRight = [];

    private $hideCreateButton;

    /**
     * @param mixed $hideCreateButton
     * @return $this
     */
    public function hideCreateButton($hideCreateButton = true)
    {
        $this->hideCreateButton = $hideCreateButton;
        return $this;
    }


    public function builderData()
    {

        $left = collect($this->left);
        $right = collect($this->right);

        if (!$this->hideCreateButton) $right->add(new CreateButton());


        foreach ($this->addRight as $addRight) {
            $right->add($addRight);
        }

        return [
            "left" => $left,
            "right" => $right
        ];
    }
}
