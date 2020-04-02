<?php


namespace SmallRuralDog\Admin\Components;

/**
 * Class Avatar
 * @package SmallRuralDog\Admin\Components
 */
class Avatar extends GridComponent
{
    protected $componentName = "Avatar";

    protected $host = "";
    /**
     * @var string
     */
    protected $icon;
    /**
     * @var string|int
     */
    protected $size = "small";
    /**
     * @var string
     */
    protected $shape = "circle";
    /**
     * @var string
     */
    protected $src;
    /**
     * @var string
     */
    protected $srcSet;
    /**
     * @var string
     */
    protected $alt;
    /**
     * @var string
     */
    protected $fit = "cover";


    protected $defaultSrc;

    public function __construct($value = null)
    {
        $this->host = \Storage::disk(config('admin.upload.disk'))->url('/');

        $this->componentValue($value);

        $this->defaultSrc = config('admin.default_avatar');
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
    public function icon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * 设置头像的大小 number / large / medium / small
     * @param int|string $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 设置头像的形状 circle / square
     * @param string $shape
     * @return $this
     */
    public function shape(string $shape)
    {
        $this->shape = $shape;
        return $this;
    }

    /**
     * 图片头像的资源地址
     * @param string $src
     * @return $this
     */
    public function src(string $src)
    {
        $this->src = $src;
        return $this;
    }

    /**
     * 以逗号分隔的一个或多个字符串列表表明一系列用户代理使用的可能的图像
     * @param string $srcSet
     * @return $this
     */
    public function srcSet(string $srcSet)
    {
        $this->srcSet = $srcSet;
        return $this;
    }

    /**
     * 描述图像的替换文本
     * @param string $alt
     * @return $this
     */
    public function alt(string $alt)
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
    public function fit(string $fit)
    {
        $this->fit = $fit;
        return $this;
    }

    /**
     * 设置默认头像
     * @param string $defaultSrc
     * @return $this
     */
    public function defaultSrc($defaultSrc)
    {
        $this->defaultSrc = $defaultSrc;
        return $this;
    }




}
