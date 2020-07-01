<?php


namespace SmallRuralDog\Admin\Components\Widgets;


use SmallRuralDog\Admin\Actions\BaseAction;

class Button extends BaseAction
{
    use \SmallRuralDog\Admin\Components\Attrs\Button;

    protected $componentName = "Button";


    const HANDLER_ROUTE = "route";
    const HANDLER_LINK = "link";
    const HANDLER_REQUEST = "request";

    protected $uri;
    protected $handler;


    public function __construct($content)
    {
        parent::__construct();

        $this->content = $content;
    }

    /**
     * @param string $content 按钮内容
     * @return $this
     */
    public static function make($content)
    {
        return new Button($content);
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
        abort_if(!in_array($handler, [self::HANDLER_LINK, self::HANDLER_REQUEST, self::HANDLER_ROUTE]), 400, "ActionButton 事件类型错误");

        $this->handler = $handler;
        return $this;
    }

    public function route($uri)
    {
        $this->uri = $uri;
        $this->handler = self::HANDLER_ROUTE;
        return $this;
    }
}
