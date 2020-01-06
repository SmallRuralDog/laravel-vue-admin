<?php


namespace SmallRuralDog\Admin\Grid\Table;


trait TraitActions
{

    protected $actions = [];
    protected $addActions = [];
    private $hide = false;
    private $hideViewAction = false;
    private $hideEditAction = false;
    private $hideDeleteAction = false;
    private $showMore = false;
    private $fixed = false;

    public function hideActions()
    {
        $this->hide = true;
        return $this;
    }

    public function hideViewAction()
    {
        $this->hideViewAction = true;
        return $this;
    }

    public function hideEditAction()
    {
        $this->hideEditAction = true;
        return $this;
    }

    public function hideDeleteAction()
    {
        $this->hideDeleteAction = true;
        return $this;
    }

    public function addAction($action)
    {
        $this->addActions = collect($this->addActions)->add($action)->all();
        return $this;
    }

    public function actionShowMore()
    {
        $this->showMore = true;
        return $this;
    }


    protected function initActions()
    {
        $actions = collect($this->actions);
        if (!$this->hideViewAction) {
            $actions->add(Action::make('view', '查看')->moreAction($this->showMore));
        }
        if (!$this->hideEditAction) {
            $actions->add(Action::make('edit', '编辑')->moreAction($this->showMore));
        }
        if (!$this->hideDeleteAction) {
            $actions->add(Action::make('delete', '删除')->moreAction($this->showMore));
        }
        foreach ($this->addActions as $addAction) {
            $actions->add($addAction);
        }

        $this->actions = [
            'hide' => $this->hide,
            'fixed' => $this->fixed,
            'data' => $this->hide ? [] : $actions->toArray()
        ];

        return $this;
    }

}
