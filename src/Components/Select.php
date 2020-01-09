<?php


namespace SmallRuralDog\Admin\Components;


class Select extends Component
{
    public $componentName = 'Select';


    protected $multiple = false;

    protected $disabled = false;
    protected $size;
    protected $clearable = false;
    protected $collapseTags = false;
    protected $multipleLimit = 0;
    protected $name;
    protected $autocomplete;
    protected $placeholder = "请选择";
    protected $filterable = false;
    protected $allowCreate = false;
    protected $allowCreateUrl;
    protected $remote = false;
    protected $remoteUrl;
    protected $loadingText = "加载中";
    protected $noMatchText = "无匹配数据";
    protected $noDataText = "无数据";
    protected $popperClass;
    protected $reserveKeyword = false;
    protected $defaultFirstOption = false;
    protected $popperAppendToBody = true;
    protected $automaticDropdown = false;

    /**
     * @var SelectOption[]
     */
    protected $options = [];

    static public function make($value = null)
    {
        return new Select($value);
    }

    /**
     * 宽度撑满
     * @param bool $block
     * @return $this
     */
    public function block($block = true)
    {
        if ($block) {
            $style = collect($this->style)->add([
                'display' => 'block'
            ]);
            $this->style($style);
        }
        return $this;
    }


    /**
     * 是否多选
     * @param bool $multiple
     * @return $this
     */
    public function multiple($multiple = true)
    {
        $this->multiple = $multiple;
        if (!$this->componentValue) $this->componentValue([]);
        return $this;
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
     * 输入框尺寸
     * @param string $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 是否可以清空选项
     * @param bool $clearable
     * @return $this
     */
    public function clearable($clearable = true)
    {
        $this->clearable = $clearable;
        return $this;
    }

    /**
     * 多选时是否将选中值按文字的形式展示
     * @param bool $collapseTags
     * @return $this
     */
    public function collapseTags($collapseTags = true)
    {
        $this->collapseTags = $collapseTags;
        return $this;
    }

    /**
     * 多选时用户最多可以选择的项目数，为 0 则不限制
     * @param int $multipleLimit
     * @return $this
     */
    public function multipleLimit($multipleLimit)
    {
        $this->multipleLimit = $multipleLimit;
        return $this;
    }

    /**
     * select input 的 name 属性
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * select input 的 autocomplete 属性
     * @param string $autocomplete
     * @return $this
     */
    public function autocomplete($autocomplete)
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    /**
     * 占位符
     * @param string $placeholder
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * 是否可搜索
     * @param bool $filterable
     * @return $this
     */
    public function filterable($filterable = true)
    {
        $this->filterable = $filterable;
        return $this;
    }

    /**
     * 是否允许用户创建新条目
     * @param string $allowCreateUrl 创建新条目Url
     * @return $this
     */
    public function allowCreate($allowCreateUrl)
    {
        $this->allowCreate = true;
        $this->allowCreateUrl = $allowCreateUrl;
        return $this;
    }

    /**
     * 是否为远程搜索
     * @param string $remoteUrl 远程搜索URL
     * @return $this
     */
    public function remote($remoteUrl)
    {
        $this->remote = true;
        $this->remoteUrl = $remoteUrl;
        return $this;
    }

    /**
     * 远程加载时显示的文字
     * @param string $loadingText
     * @return $this
     */
    public function loadingText($loadingText)
    {
        $this->loadingText = $loadingText;
        return $this;
    }

    /**
     * 搜索条件无匹配时显示的文字
     * @param string $noMatchText
     * @return $this
     */
    public function noMatchText($noMatchText)
    {
        $this->noMatchText = $noMatchText;
        return $this;
    }

    /**
     * 选项为空时显示的文字
     * @param string $noDataText
     * @return $this
     */
    public function noDataText($noDataText)
    {
        $this->noDataText = $noDataText;
        return $this;
    }

    /**
     * Select 下拉框的类名
     * @param string $popperClass
     * @return $this
     */
    public function popperClass($popperClass)
    {
        $this->popperClass = $popperClass;
        return $this;
    }

    /**
     * 多选且可搜索时，是否在选中一个选项后保留当前的搜索关键词
     * @param bool $reserveKeyword
     * @return $this
     */
    public function reserveKeyword($reserveKeyword = true)
    {
        $this->reserveKeyword = $reserveKeyword;
        return $this;
    }

    /**
     * 在输入框按下回车，选择第一个匹配项。需配合 filterable 或 remote 使用
     * @param bool $defaultFirstOption
     * @return $this
     */
    public function defaultFirstOption($defaultFirstOption = true)
    {
        $this->defaultFirstOption = $defaultFirstOption;
        return $this;
    }

    /**
     * 是否将弹出框插入至 body 元素。在弹出框的定位出现问题时，可将该属性设置为 false
     * @param bool $popperAppendToBody
     * @return $this
     */
    public function popperAppendToBody($popperAppendToBody = true)
    {
        $this->popperAppendToBody = $popperAppendToBody;
        return $this;
    }

    /**
     * 对于不可搜索的 Select，是否在输入框获得焦点后自动弹出选项菜单
     * @param bool $automaticDropdown
     * @return $this
     */
    public function automaticDropdown($automaticDropdown = true)
    {
        $this->automaticDropdown = $automaticDropdown;
        return $this;
    }

    /**
     * @param SelectOption[] $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

}
