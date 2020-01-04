<?php


namespace SmallRuralDog\Admin\Components;


class Input extends Component
{

    public $componentName = "Input";

    public $type = "text";
    public $maxlength;
    public $minlength;
    public $showWordLimit = false;
    public $placeholder;
    public $clearable = false;
    public $showPassword = false;
    public $disabled = false;
    public $size;
    public $prefixIcon;
    public $suffixIcon;
    public $rows = 2;
    public $autosize = false;
    public $autocomplete = "off";
    public $readonly = false;
    public $max;
    public $min;
    public $step;
    public $resize;
    public $autofocus = false;
    public $form;
    public $label;
    public $tabindex;
    public $validateEvent = true;



    static public function make($value = null)
    {
        return new Input($value);
    }

    /**
     * @param int $rows
     * @return $this
     */
    public function textarea($rows = 2)
    {
        $this->type = "textarea";
        $this->rows = $rows;
        return $this;
    }

    /**
     * @return $this
     */
    public function password(){
        $this->type = "password";
        return $this;
    }

    /**
     * 类型
     * text，textarea 和其他 原生 input 的 type 值
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 原生属性，最大输入长度
     * @param string $maxlength
     * @return $this
     */
    public function setMaxlength($maxlength)
    {
        $this->maxlength = $maxlength;
        return $this;
    }

    /**
     * 原生属性，最小输入长度
     * @param string $minlength
     * @return $this
     */
    public function setMinlength($minlength)
    {
        $this->minlength = $minlength;
        return $this;
    }

    /**
     * 是否显示输入字数统计，只在 type = "text" 或 type = "textarea" 时有效
     * @param bool $showWordLimit
     * @return $this
     */
    public function setShowWordLimit(bool $showWordLimit = true)
    {
        $this->showWordLimit = $showWordLimit;
        return $this;
    }

    /**
     * 输入框占位文本
     * @param string $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * 是否可清空
     * @param bool $clearable
     * @return $this
     */
    public function setClearable(bool $clearable = true)
    {
        $this->clearable = $clearable;
        return $this;
    }

    /**
     * 是否显示切换密码图标
     * @param bool $showPassword
     * @return $this
     */
    public function setShowPassword(bool $showPassword = true)
    {
        $this->showPassword = $showPassword;
        return $this;
    }

    /**
     * 禁用
     * @param bool $disabled
     * @return $this
     */
    public function setDisabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 输入框尺寸，只在 type!="textarea" 时有效
     * medium / small / mini
     * @param string $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 输入框头部图标
     * @param string $prefixIcon
     * @return $this
     */
    public function setPrefixIcon($prefixIcon)
    {
        $this->prefixIcon = $prefixIcon;
        return $this;
    }

    /**
     * 输入框尾部图标
     * @param string $suffixIcon
     * @return $this
     */
    public function setSuffixIcon($suffixIcon)
    {
        $this->suffixIcon = $suffixIcon;
        return $this;
    }

    /**
     * 输入框行数，只对 type="textarea" 有效
     * @param int $rows
     * @return $this
     */
    public function setRows(int $rows)
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * 自适应内容高度，只对 type="textarea" 有效，可传入对象，如，{ minRows: 2, maxRows: 6 }
     * @param bool $autosize
     * @return $this
     */
    public function setAutosize(bool $autosize)
    {
        $this->autosize = $autosize;
        return $this;
    }

    /**
     * 原生属性，自动补全
     * @param string $autocomplete
     * @return $this
     */
    public function setAutocomplete(string $autocomplete)
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    /**
     * 原生属性，是否只读
     * @param bool $readonly
     * @return $this
     */
    public function setReadonly(bool $readonly = true)
    {
        $this->readonly = $readonly;
        return $this;
    }

    /**
     * 原生属性，设置最大值
     * @param string $max
     * @return $this
     */
    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * 原生属性，设置最小值
     * @param string $min
     * @return $this
     */
    public function setMin($min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * 原生属性，设置输入字段的合法数字间隔
     * @param string $step
     * @return $this
     */
    public function setStep($step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * 控制是否能被用户缩放
     * @param string $resize
     * @return $this
     */
    public function setResize($resize)
    {
        $this->resize = $resize;
        return $this;
    }

    /**
     * 原生属性，自动获取焦点
     * @param bool $autofocus
     * @return $this
     */
    public function setAutofocus(bool $autofocus = true)
    {
        $this->autofocus = $autofocus;
        return $this;
    }

    /**
     * 原生属性
     * @param string $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * 输入框关联的label文字
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * 输入框的tabindex
     * @param string $tabindex
     * @return $this
     */
    public function setTabindex($tabindex)
    {
        $this->tabindex = $tabindex;
        return $this;
    }

    /**
     * 输入时是否触发表单的校验
     * @param bool $validateEvent
     * @return $this
     */
    public function setValidateEvent(bool $validateEvent = true)
    {
        $this->validateEvent = $validateEvent;
        return $this;
    }


}
