<?php


namespace SmallRuralDog\Admin\Components;


class CheckboxGroup extends Component
{
    public $componentName = "CheckboxGroup";

    /**
     * @var string
     */
    public $size;
    public $disabled = false;
    /**
     * @var int
     */
    public $min;
    /**
     * @var int
     */
    public $max;
    public $textColor = "#ffffff";
    public $fill = "#409EFF";

    /**
     * @var Checkbox[]
     */
    public $options = [];

    static public function make($value = null, $options = [])
    {
        return (new CheckboxGroup($value))->setOptions($options);
    }

    /**
     * @param string $size
     * @return $this
     */
    public function setSize(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return $this
     */
    public function setDisabled(bool $disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param int $min
     * @return $this
     */
    public function setMin(int $min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @param int $max
     * @return $this
     */
    public function setMax(int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @param string $textColor
     * @return $this
     */
    public function setTextColor(string $textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * @param string $fill
     * @return $this
     */
    public function setFill(string $fill)
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * @param Checkbox[] $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }


}
