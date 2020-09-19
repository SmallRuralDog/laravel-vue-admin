<?php


namespace SmallRuralDog\Admin\Form;


trait HasRef
{
    protected $successRefData;

    /**
     * 表单提交成功代码注入
     * @param string $ref
     * @param $refData
     * @return $this
     */
    public function successRefData($ref = "", $refData = "")
    {
        if ($refData instanceof \Closure) {
            $data = call_user_func($refData);
        } else {
            $data = $refData;
        }

        $this->successRefData = [
            'ref' => $ref,
            "data" => $data
        ];
        return $this;
    }


    public function FormRefDataBuild()
    {
        return [
            'successRefData' => $this->successRefData
        ];
    }

}
