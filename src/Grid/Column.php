<?php

namespace SmallRuralDog\Admin\Grid;

use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Grid\Column\Attributes;


class Column
{
    use Grid\Column\TraitAttributes;

    /**
     * @var Grid
     */
    protected $grid;

    protected $name;

    protected $label;


    public function __construct($name, $label)
    {
        $this->attributes = new Attributes();

        $this->name = $name;
        $this->label = $this->formatLabel($label);
        $this->initAttributes();
    }

    protected function initAttributes()
    {
        $this->attributes->prop = $this->name;
        $this->attributes->label = $this->label;
        $name = str_replace('.', '-', $this->name);
    }

    protected function formatLabel($label)
    {
        if ($label) {
            return $label;
        }
        $label = ucfirst($this->name);
        return __(str_replace(['.', '_'], ' ', $label));
    }

    public function setGrid(Grid $grid)
    {
        $this->grid = $grid;
    }


    public function getAttributes()
    {
        return $this->attributes;
    }
}
