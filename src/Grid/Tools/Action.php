<?php


namespace SmallRuralDog\Admin\Grid\Tools;


class Action
{

    public $type = "";
    public $name = "";
    public $icon = "";
    public $moreAction = true;

    public $resource;


    static public function make(string $type, string $name)
    {
        return new Action($type, $name);
    }


    public function __construct(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;

        $this->resource = url(request()->getPathInfo());
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param bool $moreAction
     * @return $this
     */
    public function moreAction(bool $moreAction = true)
    {
        $this->moreAction = $moreAction;
        return $this;
    }


}
