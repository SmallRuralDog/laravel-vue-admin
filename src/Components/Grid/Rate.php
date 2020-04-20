<?php


namespace SmallRuralDog\Admin\Components\Grid;


use SmallRuralDog\Admin\Components\Component;

class Rate extends Component
{
    protected $componentName = "Rate";

    protected $max = 5;
    protected $disabled = false;
    protected $allowHalf = false;
    protected $lowThreshold = 2;
    protected $highThreshold = 2;
    protected $colors = ['#F7BA2A', '#F7BA2A', '#F7BA2A'];
    protected $voidColor = '#C6D1DE';
    protected $disabledVoidColor = '#EFF2F7';
    protected $iconClasses = ['el-icon-star-on', 'el-icon-star-on', 'el-icon-star-on'];
    protected $voidIconClass = "el-icon-star-off";
    protected $disabledVoidIconClass = "el-icon-star-on";
    protected $showText = false;
    protected $showScore = false;
    protected $textColor = "#1F2D3D";
    protected $texts = ['极差', '失望', '一般', '满意', '惊喜'];

    static public function make($value = null)
    {
        return new Rate($value);
    }

    /**
     * 最大分值
     * @param int $max
     * @return $this
     */
    public function max($max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * 是否为只读
     * @param bool $disabled
     * @return $this
     */
    public function disabled($disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 是否允许半选
     * @param bool $allowHalf
     * @return $this
     */
    public function allowHalf($allowHalf)
    {
        $this->allowHalf = $allowHalf;
        return $this;
    }

    /**
     * 低分和中等分数的界限值，值本身被划分在低分中
     * @param int $lowThreshold
     * @return $this
     */
    public function lowThreshold($lowThreshold)
    {
        $this->lowThreshold = $lowThreshold;
        return $this;
    }

    /**
     * 高分和中等分数的界限值，值本身被划分在高分中
     * @param int $highThreshold
     * @return $this
     */
    public function highThreshold($highThreshold)
    {
        $this->highThreshold = $highThreshold;
        return $this;
    }

    /**
     * icon 的颜色。若传入数组，共有 3 个元素，为 3 个分段所对应的颜色；若传入对象，可自定义分段，键名为分段的界限值，键值为对应的颜色
     * @param array $colors
     * @return $this
     */
    public function colors($colors)
    {
        $this->colors = $colors;
        return $this;
    }

    /**
     * 未选中 icon 的颜色
     * @param string $voidColor
     * @return $this
     */
    public function voidColor($voidColor)
    {
        $this->voidColor = $voidColor;
        return $this;
    }

    /**
     * 只读时未选中 icon 的颜色
     * @param string $disabledVoidColor
     * @return $this
     */
    public function disabledVoidColor($disabledVoidColor)
    {
        $this->disabledVoidColor = $disabledVoidColor;
        return $this;
    }

    /**
     * icon 的类名。若传入数组，共有 3 个元素，为 3 个分段所对应的类名；若传入对象，可自定义分段，键名为分段的界限值，键值为对应的类名
     * @param array $iconClasses
     * @return $this
     */
    public function iconClasses($iconClasses)
    {
        $this->iconClasses = $iconClasses;
        return $this;
    }

    /**
     * 未选中 icon 的类名
     * @param string $voidIconClass
     * @return $this
     */
    public function voidIconClass($voidIconClass)
    {
        $this->voidIconClass = $voidIconClass;
        return $this;
    }

    /**
     * 只读时未选中 icon 的类名
     * @param string $disabledVoidIconClass
     * @return $this
     */
    public function disabledVoidIconClass($disabledVoidIconClass)
    {
        $this->disabledVoidIconClass = $disabledVoidIconClass;
        return $this;
    }

    /**
     * 是否显示辅助文字，若为真，则会从 texts 数组中选取当前分数对应的文字内容
     * @param bool $showText
     * @return $this
     */
    public function showText($showText=true)
    {
        $this->showText = $showText;
        return $this;
    }

    /**
     * 是否显示当前分数，show-score 和 show-text 不能同时为真
     * @param bool $showScore
     * @return $this
     */
    public function showScore($showScore=true)
    {
        $this->showScore = $showScore;
        return $this;
    }

    /**
     * 辅助文字的颜色
     * @param string $textColor
     * @return $this
     */
    public function textColor($textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }

    /**
     * 辅助文字数组
     * @param array $texts
     * @return $this
     */
    public function texts($texts)
    {
        $this->texts = $texts;
        return $this;
    }


}
