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

    public function addLeft($action)
    {
        $this->addLeft = collect($this->addLeft)->push($action)->all();
        return $this;
    }


    public function addRight($action)
    {
        $this->addRight = collect($this->addRight)->push($action)->all();
        return $this;
    }


    public function builderData()
    {

        $left = collect($this->left);
        $right = collect($this->right);

        if (!$this->hideCreateButton) $right->add(new CreateButton());

        foreach ($this->addLeft as $addLeft) {
            $left->push($addLeft);
        }

        foreach ($this->addRight as $addRight) {
            $right->prepend($addRight);
        }

        return [
            "left" => $left,
            "right" => $right
        ];
    }
}
