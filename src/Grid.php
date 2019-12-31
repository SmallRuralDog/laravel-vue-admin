<?php


namespace SmallRuralDog\Admin;


use Closure;
use Illuminate\Database\Eloquent\Model as Eloquent;
use SmallRuralDog\Admin\Grid\Column;
use SmallRuralDog\Admin\Grid\Model;
use SmallRuralDog\Admin\Grid\Table\Attributes;
use SmallRuralDog\Admin\Grid\Table\TraitAttributes;
use SmallRuralDog\Admin\Grid\Table\TraitDefaultSort;
use SmallRuralDog\Admin\Grid\Table\TraitPageAttributes;

class Grid
{
    use TraitAttributes, TraitPageAttributes, TraitDefaultSort;

    /**
     * @var Model
     */
    protected $model;
    /**
     * @var Column[]
     */
    protected $columns = [];
    protected $rows;
    public $columnAttributes = [];
    protected $withs = [];
    protected $view = 'admin::grid.table';
    protected $keyName = 'id';
    protected $selection = false;
    protected $dataUrl;


    public function __construct(Eloquent $model, Closure $builder = null)
    {
        $this->attributes = new Attributes();
        $this->dataUrl = request()->getUri();
        $this->model = new Model($model, $this);
        $this->keyName = $model->getKeyName();
        $this->defaultSort = [
            'prop' => $model->getKeyName(),
            'order' => 'desc',
            'field' => $model->getKeyName()
        ];

    }


    /**
     * @return array
     */
    public function getWiths(): array
    {
        return $this->withs;
    }

    /**
     *
     * @param array $withs
     * @return $this
     */
    public function with(array $withs)
    {
        $this->withs = $withs;

        return $this;
    }

    /**
     * 设置是否多选
     * @param bool $selection
     * @return $this
     */
    public function selection($selection = true)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Grid添加字段
     * @param string $name 对应列内容的字段名
     * @param string $label 显示的标题
     * @param string $columnKey 排序查询等数据操作字段名称
     * @return Column
     */
    public function column($name, $label = '', $columnKey = null)
    {
        return $this->addColumn($name, $label, $columnKey);
    }

    /**
     * @param string $column
     * @param string $label
     * @param $columnKey
     * @return Column
     */
    protected function addColumn($column = '', $label = '', $columnKey = null)
    {
        $column = new Column($column, $label, $columnKey);
        $column->setGrid($this);
        return $column;
    }

    /**
     * @param Column[] $columns
     */
    public function columns($columns)
    {
        if ($this->selection) {
            $column = $this->addColumn($this->model->getModel()->getKey());
            $column->setType("selection");
            $column->setAlign("center");
            $column->setWidth(50);
            $columns = collect($columns)->prepend($column)->all();
        }

        $this->columnAttributes = collect($columns)->map(function (Column $column) {
            return $column->getAttributes();
        })->toArray();
    }


    public function render()
    {
        $viewData['routers'] = [

        ];
        $viewData['keyName'] = $this->keyName;
        $viewData['defaultSort'] = $this->defaultSort;
        $viewData['columnAttributes'] = $this->columnAttributes;
        $viewData['attributes'] = (array)$this->attributes;
        $viewData['dataUrl'] = $this->dataUrl;
        $viewData['pageSizes'] = $this->pageSizes;
        $viewData['perPage'] = $this->perPage;
        $viewData['pageBackground'] = $this->pageBackground;

        return view($this->view, $viewData)->render();
    }

    public function data()
    {
        $data = $this->model->buildData();
        return [
            'code' => 200,
            'data' => $data
        ];
    }
}
