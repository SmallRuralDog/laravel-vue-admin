<?php


namespace SmallRuralDog\Admin\Form;


use SmallRuralDog\Admin\Components\Widgets\Button;
use SmallRuralDog\Admin\Form;

class FormActions
{

    protected $form;

    protected $cancelButton;
    protected $submitButton;

    protected $hideCancelButton;
    protected $hideSubmitButton;

    public function __construct(Form $form)
    {

        $this->form = $form;
        $this->cancelButton = new Button("取消");
        $this->cancelButton->type("default");
        $this->submitButton = new Button("提交");

    }

    /**
     * @return Button
     */
    public function cancelButton()
    {
        return $this->cancelButton;
    }

    /**
     * @return Button
     */
    public function submitButton()
    {
        return $this->submitButton;
    }



    /**
     * 隐藏取消按钮
     * @param mixed $hideCancelButton
     * @return $this
     */
    public function hideCancelButton($hideCancelButton)
    {
        $this->hideCancelButton = $hideCancelButton;
        return $this;
    }

    /**
     * 隐藏提交按钮
     * @param mixed $hideSubmitButton
     * @return $this
     */
    public function hideSubmitButton($hideSubmitButton)
    {
        $this->hideSubmitButton = $hideSubmitButton;
        return $this;
    }




}
