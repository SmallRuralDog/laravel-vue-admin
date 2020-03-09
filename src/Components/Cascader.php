<?php


namespace SmallRuralDog\Admin\Components;


class Cascader extends Component
{
    protected $componentName = "Cascader";
    protected $options = [];
    /**
     * @var CascaderProps;
     */
    protected $props;
    protected $size;
    protected $placeholder = "请选择";
    protected $disabled = false;
    protected $clearable = false;
    protected $showAllLevels = true;
    protected $collapseTags = false;
    protected $separator = " / ";
    protected $filterable = false;
    protected $debounce = 300;
    protected $popperClass;

    protected $panel = false;


    static public function make($value = null)
    {
        $cascader = new Cascader($value);
        $cascader->props = new CascaderProps();
        return $cascader;
    }

    /**
     * 显示为面板模式
     * @param bool $panel
     * @return $this
     */
    public function panel($panel = true)
    {
        $this->panel = $panel;
        return $this;
    }


    /**
     * 尺寸
     * @param string $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 输入框占位文本
     * @param string $placeholder
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
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
     * 是否支持清空选项
     * @param bool $clearable
     * @return $this
     */
    public function clearable($clearable = true)
    {
        $this->clearable = $clearable;
        return $this;
    }

    /**
     * 输入框中是否显示选中值的完整路径
     * @param bool $showAllLevels
     * @return $this
     */
    public function showAllLevels($showAllLevels = true)
    {
        $this->showAllLevels = $showAllLevels;
        return $this;
    }

    /**
     * 多选模式下是否折叠Tag
     * @param bool $collapseTags
     * @return $this
     */
    public function collapseTags($collapseTags = true)
    {
        $this->collapseTags = $collapseTags;
        return $this;
    }

    /**
     * 选项分隔符
     * @param string $separator
     * @return $this
     */
    public function separator($separator)
    {
        $this->separator = $separator;
        return $this;
    }

    /**
     * 是否可搜索选项
     * @param bool $filterable
     * @return $this
     */
    public function filterable($filterable = true)
    {
        $this->filterable = $filterable;
        return $this;
    }

    /**
     * debounce
     * @param int $debounce
     * @return $this
     */
    public function debounce($debounce)
    {
        $this->debounce = $debounce;
        return $this;
    }

    /**
     * 自定义浮层类名
     * @param mixed $popperClass
     * @return $this
     */
    public function popperClass($popperClass)
    {
        $this->popperClass = $popperClass;
        return $this;
    }

    /**
     * 次级菜单的展开方式
     * click / hover
     * @param string $expandTrigger
     * @return $this
     */
    public function expandTrigger($expandTrigger)
    {
        $this->props->expandTrigger = $expandTrigger;
        return $this;
    }

    /**
     * 是否多选
     * @param bool $multiple
     * @return $this
     */
    public function multiple($multiple = true)
    {
        $this->props->multiple = $multiple;
        return $this;
    }

    /**
     * 是否严格的遵守父子节点不互相关联
     * @param bool $checkStrictly
     * @return $this
     */
    public function checkStrictly($checkStrictly = true)
    {
        $this->props->checkStrictly = $checkStrictly;
        return $this;
    }

    /**
     * 在选中节点改变时，是否返回由该节点所在的各级菜单的值所组成的数组，若设置 false，则只返回该节点的值
     * @param bool $emitPath
     * @return $this
     */
    public function emitPath($emitPath = true)
    {
        $this->props->emitPath = $emitPath;
        return $this;
    }

    /**
     * 是否动态加载子节点，需与 lazyLoad 方法结合使用
     * @param bool $layz
     * @param string $lazyUrl
     * @return $this
     */
    public function lazy($layz = true, $lazyUrl)
    {
        $this->props->lazy = $layz;
        $this->props->lazyUrl = $lazyUrl;
        return $this;
    }

    /**
     * 指定选项的值为选项对象的某个属性值
     * @param string $value
     * @return $this
     */
    public function value($value)
    {
        $this->props->value = $value;
        return $this;
    }

    /**
     * 指定选项标签为选项对象的某个属性值
     * @param string $label
     * @return $this
     */
    public function label($label)
    {
        $this->props->label = $label;
        return $this;
    }

    /**
     * 指定选项的子选项为选项对象的某个属性值
     * @param string $children
     * @return $this
     */
    public function children($children)
    {
        $this->props->children = $children;
        return $this;
    }

    /**
     * 指定选项的叶子节点的标志位为选项对象的某个属性值
     * @param string $leaf
     * @return $this
     */
    public function leaf($leaf)
    {
        $this->props->leaf = $leaf;
        return $this;
    }

    /**
     * 设置选项值数组
     * @param array $options
     * @return $this
     */
    public function options($options)
    {
        $this->options = $options;
        return $this;
    }


}
