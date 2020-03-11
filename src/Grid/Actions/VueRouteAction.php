<?php


namespace SmallRuralDog\Admin\Grid\Actions;


use SmallRuralDog\Admin\Actions\BaseRowAction;

class VueRouteAction extends BaseRowAction
{

    protected $componentName = "VueRouteAction";
    protected $name = "操作";

    protected $path;

    protected $httpPath;

    public static function make()
    {
        return new VueRouteAction();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $path
     * @return $this
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param mixed $httpPath
     * @return $this
     */
    public function httpPath($httpPath)
    {
        $this->httpPath = $httpPath;
        return $this;
    }


}
