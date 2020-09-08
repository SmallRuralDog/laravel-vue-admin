<?php


namespace SmallRuralDog\Admin\Form;


use SmallRuralDog\Admin\Components\Widgets\Button;
use SmallRuralDog\Admin\Form;

class FormActions
{

    protected $form;

    protected $actions = [];
    protected $addLeftActions = [];
    protected $addRightActions = [];

    protected $cancelButton;
    protected $submitButton;

    protected $hideCancelButton;
    protected $hideSubmitButton;

    protected $fixed = false;

    public function __construct(Form $form)
    {

        $this->form = $form;
        $this->cancelButton = new Button("取消");
        $this->cancelButton->type("default");
        $this->submitButton = new Button("提交");

    }

    /**
     * 添加自定义Action
     * @param $action
     * @return $this
     */
    public function addLeft($action)
    {
        if ($action instanceof \Closure) {
            $this->addLeftActions = collect($this->addLeftActions)->push(call_user_func($action))->all();
        } else {
            $this->addLeftActions = collect($this->addLeftActions)->push($action)->all();
        }
        return $this;
    }

    /**
     * 添加自定义Action
     * @param $action
     * @return $this
     */
    public function addRight($action)
    {
        if ($action instanceof \Closure) {
            $this->addRightActions = collect($this->addRightActions)->push(call_user_func($action))->all();
        } else {
            $this->addRightActions = collect($this->addRightActions)->push($action)->all();
        }
        return $this;
    }

    /**
     * 获取取消按钮对象，注意此按钮只支持基本按钮属性
     * @return Button
     */
    public function cancelButton()
    {
        return $this->cancelButton;
    }

    /**
     * 获取提交按钮对象，注意此按钮只支持基本按钮属性
     * @return Button
     */
    public function submitButton()
    {
        return $this->submitButton;
    }


    /**
     * 隐藏取消按钮
     * @return $this
     */
    public function hideCancelButton()
    {
        $this->hideCancelButton = true;
        return $this;
    }

    /**
     * 隐藏提交按钮
     * @return $this
     */
    public function hideSubmitButton()
    {
        $this->hideSubmitButton = true;
        return $this;
    }

    /**
     * 固定操作栏
     * @return $this
     */
    public function fixed()
    {
        $this->fixed = true;
        return $this;
    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }




    public function builderActions()
    {
        $addLeftActions = collect($this->addLeftActions);
        $addRightActions = collect($this->addRightActions);


        $cancelButton = null;

        if (!$this->hideCancelButton) {
            $cancelButton = $this->cancelButton;
        }

        $submitButton = null;
        if (!$this->hideSubmitButton) {
            $submitButton = $this->submitButton;
        }

        return [
            'addLeftActions' => $addLeftActions,
            'addRightActions' => $addRightActions,
            'cancelButton' => $cancelButton,
            'submitButton' => $submitButton,
            'fixed' => $this->fixed,
        ];
    }


}
