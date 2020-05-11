<?php

namespace SmallRuralDog\Admin\Components\Widgets;

use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Layout\Content;

class Card extends Component
{
    protected $componentName = "Card";
    protected $header;
    protected $bodyStyle;
    protected $shadow = "never";

    protected $content;

    public static function make()
    {
        return new Card();
    }

    /**
     * 设置 header
     * @param string $header
     * @return $this
     */
    public function header($header)
    {
        $this->header = instance_content($header);
        return $this;
    }

    /**
     * 设置 body 的样式
     * @param array $bodyStyle
     * @return $this
     */
    public function bodyStyle($bodyStyle)
    {
        $this->bodyStyle = $bodyStyle;
        return $this;
    }

    /**
     * 设置阴影显示时机
     * always / hover / never
     * @param string $shadow
     * @return $this
     */
    public function shadow(string $shadow)
    {
        $this->shadow = $shadow;
        return $this;
    }

    /**
     * 设置内容组件
     * @param  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = instance_content($content);
        return $this;
    }

}
