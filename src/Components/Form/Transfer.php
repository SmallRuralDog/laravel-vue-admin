<?php


namespace SmallRuralDog\Admin\Components\Form;


use SmallRuralDog\Admin\Components\Attrs\TransferData;
use SmallRuralDog\Admin\Components\Component;

class Transfer extends Component
{
    protected $componentName = "Transfer";

    protected $data = [];
    protected $filterable = false;
    protected $filterPlaceholder = "请输入搜索内容";
    protected $targetOrder = "original";
    protected $titles = ['列表', '列表'];
    protected $buttonTexts=[];
    protected $leftDefaultChecked = [];
    protected $rightDefaultChecked = [];

    static public function make($value = [])
    {
        return new Transfer($value);
    }

    /**
     * Transfer 的数据源
     * array[{ key, label, disabled }]
     * @param TransferData[]|\Closure $data
     * @return $this
     */
    public function data($data)
    {
        if ($data instanceof \Closure) {
            $this->data = call_user_func($data);
        } else {
            $this->data = $data;
        }

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
     * 搜索框占位符
     * @param string $filterPlaceholder
     * @return $this
     */
    public function filterPlaceholder($filterPlaceholder)
    {
        $this->filterPlaceholder = $filterPlaceholder;
        return $this;
    }

    /**
     * 右侧列表元素的排序策略：若为 original，则保持与数据源相同的顺序；若为 push，则新加入的元素排在最后；若为 unshift，则新加入的元素排在最前
     * original / push / unshift
     * @param string $targetOrder
     * @return $this
     */
    public function targetOrder($targetOrder)
    {
        $this->targetOrder = $targetOrder;
        return $this;
    }

    /**自定义列表标题
     * @param string[] $titles
     * @return $this
     */
    public function titles($titles)
    {
        $this->titles = $titles;
        return $this;
    }

    /**
     * 自定义按钮文案
     * @param string[] $buttonTexts
     * @return $this
     */
    public function buttonTexts($buttonTexts)
    {
        $this->buttonTexts = $buttonTexts;
        return $this;
    }

    /**
     * 初始状态下左侧列表的已勾选项的 key 数组
     * @param array $leftDefaultChecked
     * @return $this
     */
    public function leftDefaultChecked($leftDefaultChecked)
    {
        $this->leftDefaultChecked = $leftDefaultChecked;
        return $this;
    }

    /**
     * 初始状态下右侧列表的已勾选项的 key 数组
     * @param array $rightDefaultChecked
     * @return $this
     */
    public function rightDefaultChecked($rightDefaultChecked)
    {
        $this->rightDefaultChecked = $rightDefaultChecked;
        return $this;
    }


}
