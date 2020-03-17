<?php


namespace SmallRuralDog\Admin\Actions;


use SmallRuralDog\Admin\Components\Attrs\Button;

class BaseRowAction extends BaseAction
{
    use Button;

    protected $icon;

    protected $order = 1;

    /**
     * @param mixed $icon
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function order(int $order)
    {
        $this->order = $order;
        return $this;
    }


}
