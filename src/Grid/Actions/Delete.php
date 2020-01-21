<?php


namespace SmallRuralDog\Admin\Grid\Actions;


use SmallRuralDog\Admin\Actions\RowAction;

class Delete extends RowAction
{
    public $actionKey = "delete";
    public $name = "删除";
    public $confirm = "你确定要删除此条数据吗？";

    public $httpMethod = "delete";

    /**
     * Delete constructor.
     */
    public function __construct()
    {
        $this->handleUrl = $this->getResource() . '/' . $this->getKey();
    }


}
