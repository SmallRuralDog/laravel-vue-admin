<?php

namespace SmallRuralDog\Admin\Grid\Filter;

use Illuminate\Support\Arr;
use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Components\Form\Input;
use SmallRuralDog\Admin\Traits\AdminJsonBuilder;

abstract class AbstractFilter extends AdminJsonBuilder
{
    protected $label;
    protected $value;
    protected $defaultValue;
    protected $column;
    protected $component;

    protected $query = 'where';

    protected $ignore = false;

    public $hideAttrs = ['value', 'query', 'ignore'];

    public function __construct($column, $label = '')
    {
        $this->column = $column;
        $this->label = $label != null ? $this->formatLabel($label) : null;
        $this->component = Input::make();

    }

    protected function formatLabel($label)
    {
        $label = $label ?: ucfirst($this->column);
        return str_replace(['.', '_'], ' ', $label);
    }

    /**
     * @param mixed $defaultValue
     * @return $this
     */
    public function defaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        if ($this->component) {
            $this->component->componentValue($defaultValue);
        }
        return $this;
    }

    /**
     * @param Component $component
     * @return $this
     */
    public function component($component)
    {
        $this->component = $component;
        if ($this->defaultValue) {
            $this->component->componentValue($this->defaultValue);
        } elseif ($this->component->getComponentValue()) {
            $this->defaultValue = $this->component->getComponentValue();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @return mixed
     */
    public function getColumn()
    {
        return $this->column;
    }

    public function condition($inputs)
    {
        if ($this->ignore) {
            return;
        }

        $value = Arr::get($inputs, $this->column);

        if (!isset($value)) {
            return;
        }

        $this->value = $value;

        return $this->buildCondition($this->column, $this->value);
    }

    protected function buildCondition()
    {
        $column = explode('.', $this->column);

        if (count($column) == 1) {
            return [$this->query => func_get_args()];
        }

        return $this->buildRelationQuery(...func_get_args());
    }

    protected function buildRelationQuery()
    {
        $args = func_get_args();

        list($relation, $args[0]) = explode('.', $this->column);

        return ['whereHas' => [$relation, function ($relation) use ($args) {
            call_user_func_array([$relation, $this->query], $args);
        }]];
    }

}
