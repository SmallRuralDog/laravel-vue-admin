<?php


namespace SmallRuralDog\Admin\Grid\Concerns;


trait HasDefaultSort
{
    protected $defaultSort;

    /**
     * @param string $prop 列表字段
     * @param string $order asc|desc
     * @param string $field 排序字段
     * @return $this
     */
    public function defaultSort($prop, $order, $field = null)
    {
        $this->defaultSort = [
            'sort_prop' => $prop,
            'sort_order' => $order,
            'sort_field' => $field ? $field : $prop
        ];
        return $this;
    }

    public function getDefaultSort()
    {
        return $this->defaultSort;
    }

}
