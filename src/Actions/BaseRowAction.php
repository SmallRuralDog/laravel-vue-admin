<?php


namespace SmallRuralDog\Admin\Actions;


use SmallRuralDog\Admin\Components\Attrs\Button;

class BaseRowAction extends BaseAction
{
    use Button;


    protected $order = 1;




    protected $vif;


    /**
     * 设置排序越大越靠前
     * @param int $order
     * @return $this
     */
    public function order(int $order)
    {
        $this->order = $order;
        return $this;
    }







    /**
     * 设置操作vif属性算法
     * @param array $vif
     * @return $this
     */
    public function vif($vif)
    {
        $this->vif = $vif;
        return $this;
    }


}
