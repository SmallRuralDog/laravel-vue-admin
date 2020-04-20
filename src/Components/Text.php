<?php


namespace SmallRuralDog\Admin\Components;

/**
 * Class Text
 * @package SmallRuralDog\Admin\Components
 * @deprecated
 */
class Text extends Component
{

    protected $componentName = "IText";

    protected $text = "";

    /**
     * LvaText constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }


    static public function make($text = "")
    {
        return new Text($text);
    }
}
