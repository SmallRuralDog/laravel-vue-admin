<?php


namespace SmallRuralDog\Admin\Layout;


use Illuminate\Contracts\Support\Renderable;
use SmallRuralDog\Admin\Grid;

class Column implements Buildable
{
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

    public function build()
    {

        $content = collect($this->contents)->map(function ($content) {
            if ($content instanceof Renderable || $content instanceof Grid) {
                return $content->render();
            } else {
                return (string)$content;
            }
        })->join('');

        return "<column-layout :span='$this->width'>$content</column-layout>";
    }
}
