<?php


namespace SmallRuralDog\Admin\Grid\Actions;


use SmallRuralDog\Admin\Components\Attrs\ElLink;
use SmallRuralDog\Admin\Components\Component;

class ActionLink extends Component
{
    use ElLink;

    protected $componentName = "ActionLink";
    protected $uri;
    protected $handler;
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    protected static function make($content)
    {
        return new ActionLink($content);
    }

    /**
     * @param mixed $uri
     * @return $this
     */
    public function uri($uri)
    {
        $this->uri = $uri;
        $this->href = $uri;
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
