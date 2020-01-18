<?php


namespace SmallRuralDog\Admin\Components;


class SelectOption implements \JsonSerializable
{
    protected $type = "default";
    protected $label;
    protected $value;
    protected $avatar;
    protected $disabled = false;

    static function make($value, $label)
    {
        $op = new SelectOption();
        $op->type = "default";
        $op->value = $value;
        $op->label = $label;
        return $op;
    }

    /**
     * 是否禁用该选项
     * @param bool $disabled
     * @return $this
     */
    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param string $avatar
     * @return $this
     */
    public function avatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }



    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $data = [];
        foreach ($this as $key => $val) {
            $data[$key] = $val;
        }
        return $data;
    }
}
