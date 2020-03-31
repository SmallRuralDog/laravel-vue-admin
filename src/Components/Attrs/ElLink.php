<?php

namespace SmallRuralDog\Admin\Components\Attrs;


trait ElLink
{
    protected $type = "default";
    protected $underline = false;
    protected $disabled = false;
    protected $href;
    protected $icon;

    /**
     * @param string $type
     * @return $this
     */
    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $underline
     * @return $this
     */
    public function underline(bool $underline = true)
    {
        $this->underline = $underline;
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


}
