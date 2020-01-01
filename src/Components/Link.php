<?php


namespace SmallRuralDog\Admin\Components;


class Link extends Component
{
    public $name = "link";
    public $type;
    public $underline;
    public $disabled = false;
    public $href;
    public $icon;

    static public function make()
    {
        return new Link();
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
     * @return Link
     */
    public function setUnderline($underline)
    {
        $this->underline = $underline;
        return $this;
    }

    /**
     * @param bool $disabled
     * @return Link
     */
    public function setDisabled(bool $disabled): Link
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param string $href
     * @return Link
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @param string $icon
     * @return Link
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }


}
