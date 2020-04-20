<?php


namespace SmallRuralDog\Admin\Components;

/**
 * @deprecated
 * Class Divider
 * @package SmallRuralDog\Admin\Components
 */
class Divider extends Component
{
    protected $componentName = "Divider";

    protected $direction = "horizontal";
    protected $contentPosition = "left";

    protected $content;

    /**
     * Divider constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    public static function make($content)
    {
        return new Divider($content);
    }


    /**
     * @param string $direction
     * @return $this
     */
    public function direction(string $direction)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * @param string $contentPosition
     * @return $this
     */
    public function contentPosition(string $contentPosition)
    {
        $this->contentPosition = $contentPosition;
        return $this;
    }


}
