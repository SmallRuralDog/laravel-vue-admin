<?php


namespace SmallRuralDog\Admin\Components\Attrs;


use SmallRuralDog\Admin\Layout\Content;

trait ElDialog
{

    protected $title;
    protected $width = "50%";
    protected $fullscreen = false;
    protected $top = "15vh";
    protected $modal = true;
    protected $lockScroll = true;
    protected $customClass;
    protected $closeOnClickModal = true;
    protected $closeOnPressEscape = true;
    protected $showClose = true;
    protected $center = false;
    protected $destroyOnClose = false;


    protected $slot;

    /**
     * @param mixed $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $width
     * @return $this
     */
    public function width(string $width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param bool $fullscreen
     * @return $this
     */
    public function fullscreen(bool $fullscreen)
    {
        $this->fullscreen = $fullscreen;
        return $this;
    }

    /**
     * @param string $top
     * @return $this
     */
    public function top(string $top)
    {
        $this->top = $top;
        return $this;
    }

    /**
     * @param bool $modal
     * @return $this
     */
    public function modal(bool $modal)
    {
        $this->modal = $modal;
        return $this;
    }

    /**
     * @param bool $lockScroll
     * @return $this
     */
    public function lockScroll(bool $lockScroll)
    {
        $this->lockScroll = $lockScroll;
        return $this;
    }

    /**
     * @param mixed $customClass
     * @return $this
     */
    public function customClass($customClass)
    {
        $this->customClass = $customClass;
        return $this;
    }

    /**
     * @param bool $closeOnClickModal
     * @return $this
     */
    public function closeOnClickModal(bool $closeOnClickModal)
    {
        $this->closeOnClickModal = $closeOnClickModal;
        return $this;
    }

    /**
     * @param bool $closeOnPressEscape
     * @return $this
     */
    public function closeOnPressEscape(bool $closeOnPressEscape)
    {
        $this->closeOnPressEscape = $closeOnPressEscape;
        return $this;
    }

    /**
     * @param bool $showClose
     * @return $this
     */
    public function showClose(bool $showClose)
    {
        $this->showClose = $showClose;
        return $this;
    }

    /**
     * @param bool $center
     * @return $this
     */
    public function center(bool $center)
    {
        $this->center = $center;
        return $this;
    }

    /**
     * @param bool $destroyOnClose
     * @return $this
     */
    public function destroyOnClose(bool $destroyOnClose)
    {
        $this->destroyOnClose = $destroyOnClose;
        return $this;
    }

    public function slot(\Closure $closure)
    {
        $this->slot = Content::make();
        call_user_func($closure, $this->slot);
    }

}
