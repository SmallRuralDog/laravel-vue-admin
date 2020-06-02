<?php

namespace SmallRuralDog\Admin\Form\Utils;

class VIfEval
{

    protected $functionPath;
    protected $functionStr;
    protected $props = [];

    /**
     * @param mixed $functionPath
     * @return VIfEval
     */
    public function functionPath($functionPath)
    {
        $this->functionPath = $functionPath;
        return $this;
    }

    /**
     * @param mixed $functionStr
     * @return VIfEval
     */
    public function functionStr($functionStr)
    {
        $this->functionStr = $functionStr;
        return $this;
    }

    /**
     * @param array $props
     * @return VIfEval
     */
    public function props(array $props)
    {
        $this->props = $props;
        return $this;
    }


    public function build()
    {
        $expression = "";
        if ($this->functionStr) {
            $expression = $this->functionStr;
        }
        if ($this->functionPath) {
            abort_if(!file_exists($this->functionPath), 400, "functionPath文件不存在");
            $expression = file_get_contents($this->functionPath);
        }

        return [
            "expression" => $expression,
            "props" => $this->props
        ];
    }
}
