<?php


namespace SmallRuralDog\Admin\Grid\Actions;


use SmallRuralDog\Admin\Actions\BaseRowAction;

class DeleteAction extends BaseRowAction
{
    protected $componentName = "DeleteAction";

    protected $type = "text";


    protected $message = "确定要删除此内容？";

    /**
     * 自定义删除确认消息
     * @param string $message
     * @return $this
     */
    public function message(string $message)
    {
        $this->message = $message;
        return $this;
    }


}
