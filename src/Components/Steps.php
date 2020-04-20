<?php


namespace SmallRuralDog\Admin\Components;


use SmallRuralDog\Admin\Components\Attrs\Step;

/**
 * Class Steps
 * @package SmallRuralDog\Admin\Components
 * @deprecated
 */
class Steps extends Component
{
    protected $componentName = "Steps";

    protected $space;
    protected $direction = "horizontal";
    protected $active = 0;
    protected $processStatus = "process";
    protected $finishStatus = "finish";
    protected $alignCenter = false;
    protected $simple = false;
    /**
     * @var Step[]
     */
    protected $stepList;

    /**
     * Steps constructor.
     */
    public function __construct()
    {
        $this->stepList = collect();
    }


    public static function make()
    {
        return new Steps();
    }

    /**
     * 每个 step 的间距，不填写将自适应间距。支持百分比。
     * @param int|string $space
     * @return $this
     */
    public function space($space)
    {
        $this->space = $space;
        return $this;
    }

    /**
     * 显示方向
     * vertical / horizontal
     * @param string $direction
     * @return $this
     */
    public function direction(string $direction)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * 设置当前激活步骤
     * @param int $active
     * @return $this
     */
    public function active(int $active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * 设置当前步骤的状态
     *    wait / process / finish / error / success
     * @param string $processStatus
     * @return $this
     */
    public function processStatus(string $processStatus)
    {
        $this->processStatus = $processStatus;
        return $this;
    }

    /**
     * 设置结束步骤的状态
     * wait / process / finish / error / success
     * @param string $finishStatus
     * @return $this
     */
    public function finishStatus(string $finishStatus)
    {
        $this->finishStatus = $finishStatus;
        return $this;
    }

    /**
     * 进行居中对齐
     * @param bool $alignCenter
     * @return $this
     */
    public function alignCenter(bool $alignCenter = true)
    {
        $this->alignCenter = $alignCenter;
        return $this;
    }

    /**
     * 是否应用简洁风格
     * @param bool $simple
     * @return $this
     */
    public function simple(bool $simple = true)
    {
        $this->simple = $simple;
        return $this;
    }

    /**
     * @param Step[]|\Closure $stepList
     * @return $this
     */
    public function stepList($stepList)
    {
        if ($stepList instanceof \Closure) {
            call_user_func($stepList, $this->stepList);
        } else {
            $this->stepList = $stepList;
        }


        return $this;
    }


}
