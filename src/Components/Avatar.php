<?php


namespace SmallRuralDog\Admin\Components;


class Avatar extends Component
{
    public $name = "avatar";
    /**
     * @var string
     */
    public $icon;
    /**
     * @var string|int
     */
    public $size = "large";
    /**
     * @var string
     */
    public $shape = "circle";
    /**
     * @var string
     */
    public $src;
    /**
     * @var string
     */
    public $srcSet;
    /**
     * @var string
     */
    public $alt;
    /**
     * @var string
     */
    public $fit = "cover";

    public function __construct($value = null)
    {
        $this->setComponentValue($value);
    }


    static public function make($value = null)
    {
        return new Avatar($value);
    }


    /**
     * 设置头像的图标类型，参考 Icon 组件
     * @param string $icon
     * @return $this
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * 设置头像的大小 number / large / medium / small
     * @param int|string $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 设置头像的形状 circle / square
     * @param string $shape
     * @return $this
     */
    public function setShape(string $shape)
    {
        $this->shape = $shape;
        return $this;
    }

    /**
     * 图片头像的资源地址
     * @param string $src
     * @return $this
     */
    public function setSrc(string $src)
    {
        $this->src = $src;
        return $this;
    }

    /**
     * 以逗号分隔的一个或多个字符串列表表明一系列用户代理使用的可能的图像
     * @param string $srcSet
     * @return $this
     */
    public function setSrcSet(string $srcSet)
    {
        $this->srcSet = $srcSet;
        return $this;
    }

    /**
     * 描述图像的替换文本
     * @param string $alt
     * @return $this
     */
    public function setAlt(string $alt)
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * 当展示类型为图片的时候，设置图片如何适应容器框
     * fill / contain / cover / none / scale-down
     * @param string $fit
     * @return $this
     */
    public function setFit(string $fit)
    {
        $this->fit = $fit;
        return $this;
    }


}
