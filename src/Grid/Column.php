<?php

namespace SmallRuralDog\Admin\Grid;

use Closure;
use SmallRuralDog\Admin\Components\GridComponent;
use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Grid\Column\Attributes;


class Column
{
    use Grid\Concerns\HasColumnAttributes;

    /**
     * @var Grid
     */
    protected $grid;
    protected $name;
    protected $label;
    protected $columnKey;
    private $columnData;

    protected $defaultValue;


    /**
     * @var Closure
     */
    protected $displayCallbacks;


    public function __construct($name, $label, $columnKey = null)
    {
        $this->attributes = new Attributes();

        $this->name = $name;
        $this->columnKey = $columnKey;
        $this->label = $this->formatLabel($label);
        $this->initAttributes();
    }

    protected function initAttributes()
    {
        $this->attributes->prop = $this->name;
        $this->attributes->label = $this->label;
        if (empty($this->columnKey)) {
            $this->columnKey = $this->name;
        }
        $this->attributes->columnKey = $this->columnKey;
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

    /**
     * 自定义值
     *
     * @param Closure $callback
     *
     * @return $this
     */
    public function customValue(Closure $callback)
    {
        $this->displayCallbacks = $callback;

        return $this;
    }

    public function customValueUsing($row, $value)
    {
        return $this->displayCallbacks ? call_user_func($this->displayCallbacks, $row, $value) : $value;
    }

    /**
     * 设置组件
     * @param $component
     * @return $this
     * @deprecated
     */
    public function displayComponent($component)
    {
        if ($component instanceof Closure) {
            $this->displayComponentAttrs(call_user_func($component));
        } else {
            $this->displayComponentAttrs($component);
        }
        return $this;
    }

    /**
     * 设置组件
     * @param $component
     * @return $this
     */
    public function component($component)
    {
        if ($component instanceof Closure) {
            $this->displayComponentAttrs(call_user_func($component));
        } else {
            $this->displayComponentAttrs($component);
        }
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return Grid
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @return array|string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return null
     */
    public function getColumnKey()
    {
        return $this->columnKey;
    }

    /**
     * 获取默认值
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * 设置默认值
     * @param mixed $defaultValue
     * @return $this
     */
    public function defaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }



}
