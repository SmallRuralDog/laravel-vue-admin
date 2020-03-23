<?php


namespace SmallRuralDog\Admin\Actions;


use SmallRuralDog\Admin\Components\Attrs\Button;

class BaseRowAction extends BaseAction
{
    use Button;


    protected $order = 1;

    protected $message;


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
     * 确认操作提示信息
     * @param mixed $message
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }




}
