<?php


namespace SmallRuralDog\Admin\Layout;

use SmallRuralDog\Admin\Components\Component;

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
            $this->column(24, $content);
        }
    }

    public function column($width, $content)
    {
        $width = $width < 1 ? round(24 * $width) : $width;
        $column = new Column($content, $width);
        $this->addColumn($column);
        return $column;
    }


    /**
     * @param Column $column
     */
    protected function addColumn(Column $column)
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
