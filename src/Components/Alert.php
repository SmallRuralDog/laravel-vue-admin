<?php


namespace SmallRuralDog\Admin\Components;


class Alert extends Component
{
    protected $componentName = "Alert";

    protected $title = "";
    protected $type = "info";
    protected $description = "";
    protected $closable = true;
    protected $center = false;
    protected $closeText = "";
    protected $showIcon = false;
    protected $effect = "light";


    public static function make($title = null, $description = null)
    {
        $alert = new Alert();

        $alert->title = $title;
        $alert->description = $description;
        return $alert;
    }

    /**
     * 标题
     * @param string $title
     * @return $this
     */
    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * 主题
     * success/warning/info/error
     * @param string $type
     * @return $this
     */
    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 辅助性文字。也可通过默认 slot 传入
     * @param string $description
     * @return $this
     */
    public function description(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 是否可关闭
     * @param bool $closable
     * @return $this
     */
    public function closable(bool $closable=true)
    {
        $this->closable = $closable;
        return $this;
    }

    /**
     * 文字是否居中
     * @param bool $center
     * @return $this
     */
    public function center(bool $center=true)
    {
        $this->center = $center;
        return $this;
    }

    /**
     * 关闭按钮自定义文本
     * @param string $closeText
     * @return $this
     */
    public function closeText(string $closeText)
    {
        $this->closeText = $closeText;
        return $this;
    }

    /**
     * 是否显示图标
     * @param bool $showIcon
     * @return $this
     */
    public function showIcon(bool $showIcon=true)
    {
        $this->showIcon = $showIcon;
        return $this;
    }

    /**
     * 选择提供的主题
     * light/dark
     * @param string $effect
     * @return $this
     */
    public function effect(string $effect)
    {
        $this->effect = $effect;
        return $this;
    }




}
