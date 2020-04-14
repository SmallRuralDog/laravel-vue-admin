<?php


namespace SmallRuralDog\Admin\Grid\BatchActions;


class DeleteAction extends BatchAction
{


    public function __construct($content)
    {
        parent::__construct($content);

        $this->content = $content;
        $this->handler = self::HANDLER_REQUEST;
        $this->requestMethod = "delete";
        $this->uri = $this->resource . '/' . $this->getKeys();
        $this->message = "确定要批量删除吗？";

        $this->beforeEmit("tableSetLoading", true);
        $this->successEmit("tableReload");
        $this->afterEmit("tableSetLoading", false);
    }


    public static function make($content = "批量删除")
    {
        return new DeleteAction($content);
    }


}
