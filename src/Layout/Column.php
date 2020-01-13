<?php


namespace SmallRuralDog\Admin\Layout;


use SmallRuralDog\Admin\Components\Component;

class Column extends Component
{

    protected $componentName = "Column";

    protected $width = 24;

    protected $contents = [];

    public function __construct($content, $width = 24)
    {
        if ($content instanceof \Closure) {
            call_user_func($content, $this);
        } else {
            $this->append($content);
        }
        $this->width = $width;

    }

    public function append($content)
    {
        $this->contents[] = $content;
        return $this;
    }

}
