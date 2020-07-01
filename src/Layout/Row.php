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
        }else{
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
}
