<?php


namespace SmallRuralDog\Admin\Layout;

use Illuminate\Contracts\Support\Renderable;

class Row implements Buildable, Renderable
{

    /**
     * @var Column[]
     */
    protected $columns = [];

    protected $class = [];


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
    }


    public function class($class)
    {
        if (is_string($class)) {
            $class = [$class];
        }
        $this->class = $class;
        return $this;
    }


    /**
     * @param Column $column
     */
    protected function addColumn(Column $column)
    {
        $this->columns[] = $column;
    }


    public function build()
    {
        $content = collect($this->columns)->map(function (Column $column) {
            return $column->build();
        })->join('');
        return "<row-layout>$content</row-layout>";
    }


    public function render()
    {
        return $this->build();
    }
}
