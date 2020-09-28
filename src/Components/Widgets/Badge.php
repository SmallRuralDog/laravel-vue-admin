<?php


namespace SmallRuralDog\Admin\Components\Widgets;


use SmallRuralDog\Admin\Components\Component;

class Badge extends Component
{
    protected $componentName = "Badge";

    protected $value;
    protected $max;
    protected $isDot = false;
    protected $hidden = false;
    protected $type;
    protected $child;

    /**
     * Badge constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
        $this->value = $value;
    }

    public static function make($value)
    {
        return new Badge($value);
    }

    /**
     * @param string|int $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param int $max
     * @return $this
     */
    public function max(int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @param bool $isDot
     * @return $this
     */
    public function isDot(bool $isDot)
    {
        $this->isDot = $isDot;
        return $this;
    }

    /**
     * @param bool $hidden
     * @return $this
     */
    public function hidden(bool $hidden)
    {
        $this->hidden = $hidden;
        return $this;
    }

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
     * @param mixed $child
     * @return $this
     */
    public function child($child)
    {
        $this->child = $child;
        return $this;
    }


}
