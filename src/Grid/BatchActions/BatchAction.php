<?php

namespace SmallRuralDog\Admin\Grid\BatchActions;

use SmallRuralDog\Admin\Actions\BaseAction;

class BatchAction extends BaseAction
{

    const HANDLER_ROUTE = "route";
    const HANDLER_LINK = "link";
    const HANDLER_REQUEST = "request";
    protected $componentName = "BatchAction";
    protected $content;
    protected $uri;
    protected $handler;
    protected $requestMethod = "get";
    protected $keys = "{keys}";
    protected $message;

    public $hideAttrs = ['keys', 'resource'];

    public function __construct($content)
    {
        parent::__construct();
        $this->content = $content;
    }

    /**
     * 批量操作名称
     * @param mixed $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param string $content 按钮内容
     * @return BatchAction
     */
    public static function make($content)
    {
        return new BatchAction($content);
    }

    /**
     * 批量操作路径
     * @param mixed $uri
     * @return $this
     */
    public function uri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * 批量操作响应事件类型
     * @param string $handler 响应类型 request|route|link
     * @return $this
     */
    public function handler($handler)
    {
        abort_if(!in_array($handler, [self::HANDLER_LINK, self::HANDLER_REQUEST, self::HANDLER_ROUTE]), 400, "ActionButton 事件类型错误");

        $this->handler = $handler;
        return $this;
    }

    /**
     * vue路由快捷设置方法
     * @param $uri
     * @return $this
     */
    public function route($uri)
    {
        $this->uri = $uri;
        $this->handler = self::HANDLER_ROUTE;
        return $this;
    }

    /**
     * 设置request模式请求类型
     * @param string $requestMethod
     * @return $this
     */
    public function requestMethod(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;
        return $this;
    }

    /**
     * 获取批量选择key
     * 注意：只可用于uri设置
     * @return string
     */
    public function getKeys(): string
    {
        return $this->keys;
    }

    /**
     * 确认操作提示信息
     * @param mixed $message
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }


}
