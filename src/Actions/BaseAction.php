<?php


namespace SmallRuralDog\Admin\Actions;


use JsonSerializable;

class BaseAction implements JsonSerializable
{
    protected $componentName = "";
    protected $className;
    protected $style;

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
