<?php

namespace SmallRuralDog\Admin\Grid\Tools;

use JsonSerializable;

class QuickSearch implements JsonSerializable
{
    public $searchKey = '__search__';
    public $placeholder = "输入搜索关键字";
    /**
     * @var array|string|\Closure
     */
    public $search;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'searchKey' => $this->searchKey,
            'placeholder' => $this->placeholder,
        ];
    }
}
