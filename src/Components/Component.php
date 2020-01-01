<?php


namespace SmallRuralDog\Admin\Components;


class Component
{
    public $className;
    public $style;

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



}
