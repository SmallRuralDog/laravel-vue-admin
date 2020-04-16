<?php

namespace SmallRuralDog\Admin\Components\Attrs;

trait Depend
{
    protected $depend;
    protected $paginate = 0;
    protected $extUrlParams;

    /**
     * @param mixed $depend
     * @return $this
     */
    public function depend($depend)
    {
        $this->depend = $depend;
        return $this;
    }

    /**
     * @param mixed $paginate
     * @return $this
     */
    public function paginate($paginate)
    {
        $this->paginate = $paginate;
        return $this;
    }
    /**
     * @param mixed $extUrlParams
     * @return $this
     */
    public function extUrlParams($extUrlParams)
    {
        $this->extUrlParams = $extUrlParams;
        return $this;
    }
}
