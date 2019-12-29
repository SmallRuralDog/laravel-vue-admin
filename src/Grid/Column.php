<?php

namespace SmallRuralDog\Admin\Grid;

use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Grid\Column\ColumnConfig;

class Column
{
    use Column\HasConfig;
    /**
     * @var Grid
     */
    protected $grid;

    protected $name;

    protected $label;

    protected $config;

    public function __construct($name, $label)
    {
        $this->config = new ColumnConfig();

        $this->name = $name;
        $this->label = $this->formatLabel($label);
        $this->initAttributes();
    }

    protected function initAttributes()
    {
        $this->config->key = $this->name;
        $this->config->title = $this->label;
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


    public function getConfig()
    {
        return $this->config;
    }
}
