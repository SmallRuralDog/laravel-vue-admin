<?php


namespace SmallRuralDog\Admin\Components\Form;


use SmallRuralDog\Admin\Components\Component;

class RadioGroup extends Component
{
    protected $componentName = "RadioGroup";

    protected $size;
    protected $disabled = false;
    protected $textColor = "#ffffff";
    protected $fill = "#409EFF";

    /**
     * @var Radio[]
     */
    public $options = [];

    /**
     * @param mixed $value
     * @param Radio[] $options
     * @return RadioGroup
     */
    public static function make($value = null, $options = [])
    {
        return (new RadioGroup($value))->options($options);
    }

    /**
     * @param string $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return RadioGroup
     */
    public function disabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param string $textColor
     * @return RadioGroup
     */
    public function textColor(string $textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * @param string $fill
     * @return RadioGroup
     */
    public function fill(string $fill)
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * @param Radio[]|\Closure $options
     * @return RadioGroup
     */
    public function options($options)
    {
        if ($options instanceof \Closure) {
            $this->options = call_user_func($options);
        } else {
            $this->options = $options;
        }

        return $this;
    }


    public function border()
    {
        collect($this->options)->each(function (Radio $radio) {
            $radio->setBorder();
        });

        return $this;
    }

}
