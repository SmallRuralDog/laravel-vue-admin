<?php


namespace SmallRuralDog\Admin\Components;


class CascaderOption extends SelectOption
{
    /**
     * @var CascaderOption[]
     */
    protected $children = [];

    protected $leaf = true;

    static function make($value, $label)
    {
        $op = new CascaderOption();
        $op->type = "default";
        $op->value = $value;
        $op->label = $label;
        return $op;
    }

    /**
     * @param CascaderOption[] $children
     * @return $this
     */
    public function children($children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @param bool $leaf
     * @return $this
     */
    public function leaf($leaf=true)
    {
        $this->leaf = $leaf;
        return $this;
    }



    public function jsonSerialize()
    {
        $data = [];
        foreach ($this as $key => $val) {
            if (!empty($val)) $data[$key] = $val;
        }
        return $data;
    }

}
