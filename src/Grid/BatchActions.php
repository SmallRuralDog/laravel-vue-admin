<?php


namespace SmallRuralDog\Admin\Grid;


use SmallRuralDog\Admin\Grid\BatchActions\DeleteAction;

class BatchActions
{
    protected $actions = [];
    protected $addActions = [];

    private $hideDeleteAction = false;
    protected $deleteAction;

    protected $keys = "selectionKeys";

    public function __construct()
    {
        $this->deleteAction = DeleteAction::make();
    }

    /**
     * 添加自定义Action
     * @param $action
     * @return $this
     */
    public function add($action)
    {
        if ($action instanceof \Closure) {
            $this->addActions = collect($this->addActions)->push(call_user_func($action))->all();
        } else {
            $this->addActions = collect($this->addActions)->push($action)->all();
        }


        return $this;
    }


    public function deleteAction()
    {
        return $this->deleteAction;
    }

    /**
     * 隐藏删除操作
     * @return $this
     */
    public function hideDeleteAction()
    {
        $this->hideDeleteAction = true;
        return $this;
    }

    /**
     * 获取当前Grid选择keys
     * @return string
     */
    public function getKeys(): string
    {
        return $this->keys;
    }



    public function builderActions()
    {
        $actions = collect($this->actions);

        if (!$this->hideDeleteAction) {
            $actions->add($this->deleteAction);
        }
        foreach ($this->addActions as $addAction) {
            $actions->add($addAction);
        }
        return $actions;
    }

}
