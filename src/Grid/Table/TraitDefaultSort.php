<?php


namespace SmallRuralDog\Admin\Grid\Table;


trait TraitDefaultSort
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
            'prop' => $prop,
            'order' => $order,
            'field' => $field ? $field : $prop
        ];
        return $this;
    }

    public function getDefaultSort()
    {
        return $this->defaultSort;
    }

}
