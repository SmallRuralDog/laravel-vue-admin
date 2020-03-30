<?php


namespace SmallRuralDog\Admin\Components;


class Html extends Component
{
    protected $componentName = "Html";

    protected $html = "";

    public static function make()
    {
        return new Html();
    }

    /**
     * @param string $html
     * @return $this
     */
    public function html(string $html)
    {
        $this->html = $html;
        return $this;
    }


}
