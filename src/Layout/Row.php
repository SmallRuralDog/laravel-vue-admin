<?php

namespace SmallRuralDog\Admin\Layout;

use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Components\Widgets\Html;

class Row extends Component
{

    protected $componentName = "Row";

    /**
     * @var Column[]
     */
    protected $columns = [];

    protected $gutter = 0;
    protected $type;
    protected $justify = "start";
    protected $align = "top";
    protected $tag = "div";

    public function __construct($content = '')
    {
        if (!empty($content)) {
            if (is_string($content)) {
                $this->column(24, Html::make()->html($content));
            }
            $this->column(24, $content);
        }
    }

    public function item($item)
    {
        if ($item instanceof \Closure) {
            $this->addColumn(call_user_func($item));
        } else {
            $this->addColumn($item);
        }

    }

    public function column($width, $content)
    {
        $width = $width < 1 ? round(24 * $width) : $width;
        $column = new Column($content, $width);
        $this->addColumn($column);
        return $column;
    }


    protected function addColumn($column)
    {
        $this->columns[] = $column;
    }

    /**
     * 栅格间隔
     * @param int $gutter
     * @return $this
     */
    public function gutter($gutter)
    {
        $this->gutter = $gutter;
        return $this;
    }

    /**
     * 布局模式，可选 flex，现代浏览器下有效
     * @param mixed $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * flex 布局下的水平排列方式
     * start/end/center/space-around/space-between
     * @param string $justify
     * @return $this
     */
    public function justify(string $justify)
    {
        $this->justify = $justify;
        return $this;
    }

    /**
     * flex 布局下的垂直排列方式
     * @param string $align
     * @return $this
     */
    public function align(string $align)
    {
        $this->align = $align;
        return $this;
    }

    /**
     * 自定义元素标签
     * @param string $tag
     * @return $this
     */
    public function tag(string $tag)
    {
        $this->tag = $tag;
        return $this;
    }


}
