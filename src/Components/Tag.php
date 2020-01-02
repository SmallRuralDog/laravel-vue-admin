<?php


namespace SmallRuralDog\Admin\Components;


class Tag extends Component
{
    public $name = "tag";
    public $type;
    public $closable = false;
    public $disableTransitions = false;
    public $hit = false;
    public $color;
    public $size = "mini";
    public $effect = "light";

    public function __construct($value = null)
    {
        $this->setComponentValue($value);
    }

    static public function make($value = null)
    {
        return new Tag($value);
    }


    /**
     * 类型   success/info/warning/danger
     * @param string|array $type
     * @param bool $random
     * @return $this
     */
    public function setType($type = null, $random = true)
    {
        $type = empty($type) ? ['success', 'info', 'warning', 'danger'] : $type;

        $this->type = [
            'data' => $type,
            'random' => $random
        ];

        return $this;
    }

    /**
     * 是否可关闭
     * @param bool $closable
     * @return $this
     */
    public function setClosable(bool $closable = true)
    {
        $this->closable = $closable;
        return $this;
    }

    /**
     * 是否禁用渐变动画
     * @param bool $disableTransitions
     * @return $this
     */
    public function setDisableTransitions(bool $disableTransitions = true)
    {
        $this->disableTransitions = $disableTransitions;
        return $this;
    }

    /**
     * 是否有边框描边
     * @param bool $hit
     * @return $this
     */
    public function setHit(bool $hit = true)
    {
        $this->hit = $hit;
        return $this;
    }

    /**
     * 背景色
     * @param string|array $color
     * @param bool $random
     * @return $this
     */
    public function setColor($color, $random = true)
    {
        $this->color = [
            'data' => $color,
            'random' => $random
        ];;
        return $this;
    }

    /**
     * 尺寸 medium / small / mini
     * @param string $size
     * @return $this
     */
    public function setSize(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 主题    dark / light / plain
     * @param string $effect
     * @return $this
     */
    public function setEffect(string $effect)
    {
        $this->effect = $effect;
        return $this;
    }


}
