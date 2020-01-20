<?php


namespace SmallRuralDog\Admin\Components;


class Component implements \JsonSerializable
{
    protected $componentName = "";
    protected $className;
    protected $style;
    protected $componentValue;

    protected $hideAttrs = [];

    public function __construct($value = null)
    {
        $this->componentValue($value);
    }

    /**
     * @param mixed $className
     * @return $this
     */
    public function className($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @param mixed $style
     * @return $this
     */
    public function style($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function componentValue($value)
    {
        $this->componentValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComponentValue()
    {
        return $this->componentValue;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $data = [];

        $hide = collect($this->hideAttrs)->push("hideAttrs")->toArray();

        foreach ($this as $key => $val) {
            if (!in_array($key, $hide)) {
                $data[$key] = $val;
            }
        }
        return $data;
    }
}
