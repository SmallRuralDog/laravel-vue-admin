<?php


namespace SmallRuralDog\Admin\Actions;


use JsonSerializable;
use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Grid\BatchActions\BatchAction;
use SmallRuralDog\Admin\Grid\Concerns\HasDialog;

class BaseAction extends Component implements JsonSerializable
{
    use HasDialog;

    const HANDLER_ROUTE = "route";
    const HANDLER_LINK = "link";
    const HANDLER_REQUEST = "request";

    protected $componentName = "";
    protected $className;
    protected $style;
    protected $resource;

    protected $message;
    protected $tooltip;

    protected $requestMethod = "get";

    protected $beforeEmit = [];
    protected $afterEmit = [];
    protected $successEmit = [];

    public $hideAttrs = [];

    /**
     * BaseAction constructor.
     */
    public function __construct()
    {
        $this->resource = admin_api_url(request()->path());
    }

    /**
     * 设置request模式请求类型
     * @param string $requestMethod
     * @return $this
     */
    public function requestMethod(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;
        return $this;
    }

    /**
     * 确认操作提示信息
     * @param mixed $message
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * 按钮气泡信息
     * @param mixed $tooltip
     * @return $this
     */
    public function tooltip($tooltip)
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    /**
     * 请求前出发事件
     * @param string $beforeEmit
     * @param mixed $data
     * @return $this
     */
    public function beforeEmit(string $beforeEmit, $data=null)
    {
        $this->beforeEmit = collect($this->beforeEmit)->add(["eventName" => $beforeEmit, "eventData" => $data]);
        return $this;
    }

    /**
     * 操作成功后触发事件
     * @param string $successEmit
     * @param mixed $data
     * @return $this
     */
    public function successEmit(string $successEmit, $data=null)
    {
        $this->successEmit = collect($this->successEmit)->add(["eventName" => $successEmit, "eventData" => $data]);
        return $this;
    }

    /**
     * 操作完成后触发事件，失败成功都会触发
     * @param string $afterEmit
     * @param mixed $data
     * @return $this
     */
    public function afterEmit(string $afterEmit, $data=null)
    {
        $this->afterEmit = collect($this->afterEmit)->add(["eventName" => $afterEmit, "eventData" => $data]);
        return $this;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getResource()
    {
        return $this->resource;
    }






    public function jsonSerialize()
    {
        $data = [];
        $hide = collect($this->hideAttrs)->push("hideAttrs")->toArray();
        foreach ($this as $key => $val) {
            if (!in_array($key, $hide)) {
                $data[$key] = $val;
            }
        }
        return $data;
    }
}
