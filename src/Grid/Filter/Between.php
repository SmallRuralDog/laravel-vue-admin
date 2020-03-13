<?php

namespace SmallRuralDog\Admin\Grid\Filter;

use Illuminate\Support\Arr;

class Between extends AbstractFilter
{


    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function condition($inputs)
    {
        if (!Arr::has($inputs, $this->column)) {
            return;
        }

        $this->value = Arr::get($inputs, $this->column);

        if (!is_array($this->value)) {
            return;
        }

        $value = array_filter($this->value, function ($val) {
            return $val !== '';
        });

        if (empty($value)) {
            return;
        }

        if (!isset($value[0])) {
            return $this->buildCondition($this->column, '<=', $value[0]);
        }

        if (!isset($value[1])) {
            return $this->buildCondition($this->column, '>=', $value[1]);
        }

        $this->query = 'whereBetween';

        return $this->buildCondition($this->column, $this->value);
    }


}
