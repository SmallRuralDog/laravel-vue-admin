<?php


namespace SmallRuralDog\Admin\Components\Grid;


use SmallRuralDog\Admin\Components\GridComponent;

class Route extends GridComponent
{
    protected $componentName = "GridRoute";

    protected $uri;

    protected $type;
    protected $icon;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }


    public static function make($url = "")
    {
        return new Route($url);
    }

    /**
     * 类型
     * primary / success / warning / danger / info
     * @param mixed $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 图标类名
     * @param mixed $icon
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }




}
