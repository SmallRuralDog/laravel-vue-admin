<?php


namespace SmallRuralDog\Admin\Components\Grid;


use SmallRuralDog\Admin\Components\GridComponent;

class Tag extends GridComponent
{
    protected $componentName = "Tag";
    protected $type;
    protected $closable = false;
    protected $disableTransitions = false;
    protected $hit = false;
    protected $color;
    protected $size = "mini";
    protected $effect = "light";


    /**
     * @param  $value
     * @return Tag
     */
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
    public function type($type = null, $random = true)
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
    public function closable(bool $closable = true)
    {
        $this->closable = $closable;
        return $this;
    }

    /**
     * 是否禁用渐变动画
     * @param bool $disableTransitions
     * @return $this
     */
    public function disableTransitions(bool $disableTransitions = true)
    {
        $this->disableTransitions = $disableTransitions;
        return $this;
    }

    /**
     * 是否有边框描边
     * @param bool $hit
     * @return $this
     */
    public function hit(bool $hit = true)
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
    public function color($color, $random = true)
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
    public function size(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 主题    dark / light / plain
     * @param string $effect
     * @return $this
     */
    public function effect(string $effect)
    {
        $this->effect = $effect;
        return $this;
    }


}
