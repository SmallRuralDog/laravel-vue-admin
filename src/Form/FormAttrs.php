<?php

namespace SmallRuralDog\Admin\Form;


class FormAttrs
{
    public $className;
    public $style;

    public $rules;
    public $inline = false;
    public $labelPosition = 'right';
    public $labelWidth = "120px";
    public $labelSuffix = "：";
    public $hideRequiredAsterisk = false;
    public $showMessage = true;
    public $inlineMessage = false;
    public $statusIcon = false;
    public $validateOnRuleChange = true;
    public $size="small";
    public $disabled = false;

}
