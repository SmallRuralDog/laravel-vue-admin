<?php


namespace SmallRuralDog\Admin\Components;


class Tooltip extends Component
{
    protected $componentName = "Tooltip";
    protected $effect = "dark";
    protected $content = "";
    protected $placement = "bottom";
    protected $disabled = false;
    protected $offset = 0;
    protected $transition = "el-fade-in-linear";
    protected $visibleArrow = true;
    protected $openDelay = 0;
    protected $manual = false;
    protected $popperClass = "";
    protected $enterable = true;
    protected $hideAfter = 0;
    protected $tabindex = 0;
    protected $slot;

    /**
     * Tooltip constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }


    public static function make($content)
    {
        return new Tooltip($content);

    }

    /**
     * @param string $effect
     * @return $this
     */
    public function effect(string $effect)
    {
        $this->effect = $effect;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return $this
     */
    public function disabled(bool $disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }



    /**
     * @param string $content
     * @return $this
     */
    public function content(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param string $placement
     * @return $this
     */
    public function placement(string $placement)
    {
        $this->placement = $placement;
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param string $transition
     * @return $this
     */
    public function transition(string $transition)
    {
        $this->transition = $transition;
        return $this;
    }

    /**
     * @param bool $visibleArrow
     * @return $this
     */
    public function visibleArrow(bool $visibleArrow)
    {
        $this->visibleArrow = $visibleArrow;
        return $this;
    }

    /**
     * @param int $openDelay
     * @return $this
     */
    public function openDelay(int $openDelay)
    {
        $this->openDelay = $openDelay;
        return $this;
    }

    /**
     * @param bool $manual
     * @return $this
     */
    public function manual(bool $manual)
    {
        $this->manual = $manual;
        return $this;
    }

    /**
     * @param string $popperClass
     * @return $this
     */
    public function popperClass(string $popperClass)
    {
        $this->popperClass = $popperClass;
        return $this;
    }

    /**
     * @param bool $enterable
     * @return $this
     */
    public function enterable(bool $enterable)
    {
        $this->enterable = $enterable;
        return $this;
    }

    /**
     * @param int $hideAfter
     * @return $this
     */
    public function hideAfter(int $hideAfter)
    {
        $this->hideAfter = $hideAfter;
        return $this;
    }

    /**
     * @param int $tabindex
     * @return $this
     */
    public function tabindex(int $tabindex)
    {
        $this->tabindex = $tabindex;
        return $this;
    }

    /**
     * @param mixed $slot
     * @return $this
     */
    public function slot($slot)
    {
        if ($slot instanceof \Closure) {
            $this->slot = call_user_func($slot);
        } else {
            $this->slot = $slot;
        }
        return $this;
    }


}
