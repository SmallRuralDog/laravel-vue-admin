<?php

namespace SmallRuralDog\Admin\Actions;

use JsonSerializable;

class Action implements JsonSerializable
{
    public $actionKey;
    public $name;
    public $icon;
    public $confirm;

    /**
     * 跳转链接
     * @var string
     */
    public $href;
    /**
     * vue route 链接
     * @var string
     */
    public $vueRoute;
    /**
     * http请求链接
     * @var string
     */
    public $handleUrl;
    /**
     * http请求方式
     * @var string
     */
    public $httpMethod = "get";
    /**
     * 请求成功触发事件
     * @var string
     */
    public $emit;

    public $hideAttrs = [];


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
