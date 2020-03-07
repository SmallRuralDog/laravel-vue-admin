<?php


namespace SmallRuralDog\Admin\Grid\Concerns;

use SmallRuralDog\Admin\Grid\Actions\DeleteAction;
use SmallRuralDog\Admin\Grid\Actions\EditAction;
use SmallRuralDog\Admin\Grid\Tools\Action;

trait HasActions
{

    protected $actions = [];
    protected $addActions = [];
    private $hide = false;
    private $hideViewAction = false;
    private $hideEditAction = false;
    private $hideDeleteAction = false;
    private $showMore = false;
    private $fixed = false;

    /**
     * 隐藏所有操作
     * @return $this
     */
    public function hideActions()
    {
        $this->hide = true;
        return $this;
    }

    /**
     * 隐藏详情操作
     * @return $this
     */
    public function hideViewAction()
    {
        $this->hideViewAction = true;
        return $this;
    }

    /**
     * 隐藏编辑操作
     * @return $this
     */
    public function hideEditAction()
    {
        $this->hideEditAction = true;
        return $this;
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
     * 添加自定义Action
     * @param $action
     * @param bool $prepend
     * @return $this
     */
    public function add($action, $prepend = false)
    {
        if ($prepend) {
            $this->addActions = collect($this->addActions)->prepend($action)->all();
        } else {
            $this->addActions = collect($this->addActions)->push($action)->all();
        }

        return $this;
    }


    public function builderActions()
    {
        $actions = collect($this->actions);

        if (!$this->hideEditAction) {
            $actions->add(new EditAction());
        }
        if (!$this->hideDeleteAction) {
            $actions->add(new DeleteAction());
        }
        foreach ($this->addActions as $addAction) {
            $actions->add($addAction);
        }

        return [
            'hide' => $this->hide,
            'data' => $actions
        ];
    }

}
