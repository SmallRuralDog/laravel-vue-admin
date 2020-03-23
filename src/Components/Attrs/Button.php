<?php

namespace SmallRuralDog\Admin\Components\Attrs;

trait Button
{
    protected $content;
    protected $size;
    protected $type = "primary";
    protected $plain = false;
    protected $round = false;
    protected $circle = false;
    protected $disabled = false;
    protected $icon;
    protected $autofocus = false;

    /**
     * @param mixed $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }


    /**
     * @param mixed $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $plain
     * @return $this
     */
    public function plain(bool $plain = true)
    {
        $this->plain = $plain;
        return $this;
    }

    /**
     * @param bool $round
     * @return $this
     */
    public function round(bool $round = true)
    {
        $this->round = $round;
        return $this;
    }

    /**
     * @param bool $circle
     * @return $this
     */
    public function circle(bool $circle = true)
    {
        $this->circle = $circle;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return $this
     */
    public function disabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param mixed $icon
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param bool $autofocus
     * @return $this
     */
    public function autofocus(bool $autofocus = true)
    {
        $this->autofocus = $autofocus;
        return $this;
    }


}
