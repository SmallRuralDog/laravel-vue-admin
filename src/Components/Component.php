<?php


namespace SmallRuralDog\Admin\Components;


class Component
{
    public $className;
    public $style;

    public $componentValue;

    public function __construct($value = null)
    {
        $this->setComponentValue($value);
    }

    /**
     * @param mixed $className
     * @return $this
     */
    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @param mixed $style
     * @return $this
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setComponentValue($value)
    {
        $this->componentValue = $value;
        return $this;
    }

}
