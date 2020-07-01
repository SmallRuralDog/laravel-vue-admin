<?php


namespace SmallRuralDog\Admin\Components\Widgets;


use SmallRuralDog\Admin\Components\Component;

class Markdown extends Component
{
    protected $componentName = "Markdown";

    protected $content;


    public function __construct($content)
    {

        $this->content = $content;
    }

    public static function make($content=""){
        return new Markdown($content);
    }


    public function content($content)
    {
        $this->content = $content;
        return $this;
    }


}
