<?php


namespace SmallRuralDog\Admin\Components;


class Image extends GridComponent
{
    protected $componentName = "IImage";
    protected $src;
    protected $host = "";
    protected $fit = "cover";
    protected $lazy = false;
    protected $scrollContainer;
    protected $preview = false;
    protected $zIndex = 2000;


    public function __construct($value = null)
    {
        $this->host = \Storage::disk(config('admin.upload.disk'))->url('/');

        $this->componentValue($value);
    }


    static public function make($value = null)
    {
        return new Image($value);
    }

    /**
     * 图片源，同原生
     * @param mixed $src
     * @return $this
     */
    public function src($src)
    {
        $this->src = $src;
        return $this;
    }

    /**
     * 确定图片如何适应容器框，同原生 object-fit
     * @param string $fit
     * @return $this
     */
    public function fit($fit)
    {
        $this->fit = $fit;
        return $this;
    }

    /**
     * 是否开启懒加载
     * @param bool $lazy
     * @return $this
     */
    public function lazy($lazy = true)
    {
        $this->lazy = $lazy;
        return $this;
    }

    /**
     * 开启懒加载后，监听 scroll 事件的容器
     * @param mixed $scrollContainer
     * @return $this
     */
    public function scrollContainer($scrollContainer)
    {
        $this->scrollContainer = $scrollContainer;
        return $this;
    }

    /**
     * 开启图片预览功能
     * @param bool $preview
     * @return $this
     */
    public function preview($preview = true)
    {
        $this->preview = $preview;
        return $this;
    }

    /**
     * 设置图片预览的 z-index
     * @param int $zIndex
     * @return $this
     */
    public function zIndex($zIndex)
    {
        $this->zIndex = $zIndex;
        return $this;
    }

    /**
     * 设置图片大小
     * @param $width
     * @param $height
     * @return $this
     */
    public function size($width = null, $height = null)
    {
        if ($width) $this->style(collect($this->style)->add(['width' => is_int($width) ? $width . 'px' : $width]));
        if ($height) $this->style(collect($this->style)->add(['height' => is_int($height) ? $height . 'px' : $height]));

        return $this;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function host(string $host)
    {
        $this->host = $host;
        return $this;
    }


}
