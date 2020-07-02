<?php


namespace SmallRuralDog\Admin\Components;


use SmallRuralDog\Admin\Traits\AdminJsonBuilder;

/**
 * 组件基类
 * Class Component
 * @package SmallRuralDog\Admin\Components
 */
class Component extends AdminJsonBuilder
{
    protected $componentName = "";
    protected $className;
    protected $style;
    protected $componentValue;


    protected $ref;

    protected $refData;


    public function __construct($value = null)
    {
        $this->componentValue($value);
    }

    /**
     * class
     * @param mixed $className
     * @return $this
     */
    public function className($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * style
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
     * @return mixed
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * 注册ref
     * @param string $ref
     * @return Component
     */
    public function ref(string $ref)
    {
        $this->ref = $ref;
        return $this;
    }


    /**
     * ref动态注入
     * @param string $ref
     * @param string $refData
     * @return $this
     */
    public function refData(string $ref, string $refData)
    {
        $this->refData = [
            'ref' => $ref,
            "data" => $refData
        ];
        return $this;
    }


}
