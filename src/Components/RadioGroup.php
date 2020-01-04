<?php


namespace SmallRuralDog\Admin\Components;


class RadioGroup extends Component
{
    public $componentName = "RadioGroup";

    public $size;
    public $disabled = false;
    public $textColor = "#ffffff";
    public $fill = "#409EFF";

    /**
     * @var Radio[]
     */
    public $options = [];

    /**
     * @param mixed $value
     * @param Radio[] $options
     * @return RadioGroup
     */
    static public function make($value = null, $options = [])
    {
        return (new RadioGroup($value))->setOptions($options);
    }

    /**
     * @param string $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return RadioGroup
     */
    public function setDisabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param string $textColor
     * @return RadioGroup
     */
    public function setTextColor(string $textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * @param string $fill
     * @return RadioGroup
     */
    public function setFill(string $fill)
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * @param Radio[] $options
     * @return RadioGroup
     */
    protected function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }


    public function setBorder()
    {
        collect($this->options)->each(function (Radio $radio) {
            $radio->setBorder();
        });

        return $this;
    }

}
