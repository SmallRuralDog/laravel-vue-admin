<?php

namespace SmallRuralDog\Admin\Components\Antv;

use Illuminate\Support\Str;
use SmallRuralDog\Admin\Components\Component;

class Line extends Component
{
    protected $componentName = "AntvLine";
    protected $canvasId;

    protected $data;
    protected $config;

    public function __construct()
    {
        $this->canvasId = Str::random();
    }


    public static function make()
    {
        return new Line();
    }

    /**
     * 设置数据
     * @param mixed $data
     * @return $this
     */
    public function data($data)
    {
        if ($data instanceof \Closure) {
            $this->data = call_user_func($data);
        } else {
            $this->data = $data;
        }


        return $this;
    }

    /**
     * 设置配置信息
     * @param mixed $config
     * @return $this
     */
    public function config($config)
    {
        if ($config instanceof \Closure) {
            $this->config = call_user_func($config);
        } else {
            $this->config = $config;
        }

        return $this;
    }


}
