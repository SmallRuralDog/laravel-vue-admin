<?php


namespace SmallRuralDog\Admin\Grid\Table;


trait TraitPageAttributes
{
    protected $pageSizes = [10, 15, 20, 30, 50, 100];
    protected $perPage = 15;

    protected $pageBackground = true;

    /**
     * 每页显示个数选择器的选项设置
     * @param array $sizes
     * @return $this
     */
    public function pageSizes($sizes)
    {
        $this->pageSizes = $sizes;

        return $this;
    }

    /**
     * 每页显示条目个数
     * @param int $perPage
     * @return $this
     */
    public function perPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * 是否为分页按钮添加背景色
     * @param bool $pageBackground
     * @return $this
     */
    public function pageBackground(bool $pageBackground = true)
    {
        $this->pageBackground = $pageBackground;

        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }


}
