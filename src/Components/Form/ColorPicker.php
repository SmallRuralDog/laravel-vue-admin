<?php


namespace SmallRuralDog\Admin\Components\Form;


use SmallRuralDog\Admin\Components\Component;

class ColorPicker extends Component
{
    protected $componentName = "ColorPicker";
    protected $disabled = false;
    /**
     * @var string
     */
    protected $size;
    protected $showAlpha = false;
    /**
     * @var string
     */
    protected $colorFormat;
    /**
     * @var string
     */
    protected $popperClass;
    protected $predefine = [];

    static public function make($value = null)
    {
        return new ColorPicker($value);
    }

    /**
     * 是否禁用
     * @param bool $disabled
     * @return $this
     */
    public function disabled($disabled = true)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * 尺寸 medium / small / mini
     * @param string $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 是否支持透明度选择
     * @param bool $showAlpha
     * @return $this
     */
    public function showAlpha($showAlpha = true)
    {
        $this->showAlpha = $showAlpha;
        return $this;
    }

    /**
     * 写入 v-model 的颜色的格式
     * hsl / hsv / hex / rgb
     * @param string $colorFormat
     * @return $this
     */
    public function colorFormat($colorFormat)
    {
        $this->colorFormat = $colorFormat;
        return $this;
    }

    /**
     * ColorPicker 下拉框的类名
     * @param string $popperClass
     * @return $this
     */
    public function popperClass($popperClass)
    {
        $this->popperClass = $popperClass;
        return $this;
    }

    /**
     * 预定义颜色
     * @param array $predefine
     * @return $this
     */
    public function predefine($predefine)
    {
        $this->predefine = $predefine;
        return $this;
    }


}
