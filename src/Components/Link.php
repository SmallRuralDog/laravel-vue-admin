<?php


namespace SmallRuralDog\Admin\Components;


class Link extends Component
{
    public $componentName = "Link";
    public $type;
    public $underline;
    public $disabled = false;
    public $href;
    public $icon;

    public function __construct($value = null)
    {
        $this->setComponentValue($value);
    }


    static public function make($value = null)
    {
        return new Link($value);
    }

    /**
     * 类型   success/info/warning/danger
     * @param string|array $type
     * @param bool $random
     * @return $this
     */
    public function setType($type = null, $random = true)
    {
        $type = empty($type) ? ['primary', 'success', 'info', 'warning', 'danger'] : $type;

        $this->type = [
            'data' => $type,
            'random' => $random
        ];

        return $this;
    }

    /**
     * @param bool $underline
     * @return $this
     */
    public function setUnderline($underline = true)
    {
        $this->underline = $underline;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return $this
     */
    public function setDisabled(bool $disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }


}
