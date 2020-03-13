<?php


namespace SmallRuralDog\Admin\Grid\Actions;


use SmallRuralDog\Admin\Actions\BaseRowAction;
use SmallRuralDog\Admin\Components\Attrs\Button;

class ActionButton extends BaseRowAction
{
    use Button;
    protected $uri;
    protected $componentName = "ActionButton";
    protected $handler;


    public function __construct($content)
    {
        $this->content = $content;
        $this->type("text");
    }

    /**
     * @param string $content 按钮内容
     * @return ActionButton
     */
    public static function make($content)
    {
        return new ActionButton($content);
    }

    /**
     * @param mixed $uri
     * @return $this
     */
    public function uri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param string $handler 响应类型 request|route|link
     * @return $this
     */
    public function handler($handler)
    {
        $this->handler = $handler;
        return $this;
    }
}
