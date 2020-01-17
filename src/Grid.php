<?php


namespace SmallRuralDog\Admin;


use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Grid\Column;
use SmallRuralDog\Admin\Grid\Concerns\HasGridAttributes;
use SmallRuralDog\Admin\Grid\Model;
use SmallRuralDog\Admin\Grid\Table\Attributes;
use SmallRuralDog\Admin\Grid\Concerns\HasActions;
use SmallRuralDog\Admin\Grid\Concerns\HasAttributes;
use SmallRuralDog\Admin\Grid\Concerns\HasDefaultSort;
use SmallRuralDog\Admin\Grid\Concerns\HasPageAttributes;
use SmallRuralDog\Admin\Grid\Concerns\HasQuickSearch;

class Grid extends Component implements \JsonSerializable
{
    use HasGridAttributes, HasPageAttributes, HasDefaultSort, HasActions, HasQuickSearch;

    protected $componentName = 'Grid';
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
    protected $tree = false;
    protected $dataUrl;

    protected $isGetData = false;


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
        $this->isGetData = request('get_data') == "true";

    }

    /**
     * 获取自定义数据模型
     * @return Model|Builder
     */
    public function model()
    {
        return $this->model;
    }


    /**
     * 获取with
     * @return array
     */
    public function getWiths(): array
    {
        return $this->withs;
    }

    /**
     *设置with
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
     * 设置树形表格
     * @param bool $tree
     * @return $this
     */
    public function tree($tree = true)
    {
        $this->tree = $tree;
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
     * @param string $name
     * @param string $label
     * @param $columnKey
     * @return Column
     */
    protected function addColumn($name = '', $label = '', $columnKey = null)
    {
        $column = new Column($name, $label, $columnKey);
        $column->setGrid($this);
        $this->columns[] = $column;
        return $column;
    }

    /**
     * @param Column[] $columns
     */
    public function columns($columns)
    {
        if ($this->tree) {
            $column = $this->addColumn($this->model()->getModel()->getKeyName());
            $column->type("expand");
            $column->align("center");
            $column->width(50);
            $columns = collect($columns)->prepend($column)->all();
        }
        if ($this->selection) {
            $column = $this->addColumn($this->model->getModel()->getKey());
            $column->type("selection");
            $column->align("center");
            $column->width(50);
            $columns = collect($columns)->prepend($column)->all();
        }

        $this->columnAttributes = collect($columns)->map(function (Column $column) {
            return $column->getAttributes();
        })->toArray();
    }

    public function getColumns()
    {
        return $this->columns;
    }

    protected function applyQuery()
    {
        $this->applyQuickSearch();
    }

    /**
     * data
     * @return array
     */
    public function data()
    {

        $collection = $this->applyQuery();

        $data = $this->model->buildData();
        return [
            'code' => 200,
            'data' => $data
        ];
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {


        if ($this->isGetData) {
            return $this->data();
        } else {
            $this->initActions();
            $viewData['componentName'] = $this->componentName;
            $viewData['routers'] = [
                'resource' => url(request()->getPathInfo())
            ];
            $viewData['keyName'] = $this->keyName;
            $viewData['selection'] = $this->selection;
            $viewData['tree'] = $this->tree;
            $viewData['defaultSort'] = $this->defaultSort;
            $viewData['columnAttributes'] = $this->columnAttributes;
            $viewData['attributes'] = (array)$this->attributes;
            $viewData['dataUrl'] = $this->dataUrl;
            $viewData['pageSizes'] = $this->pageSizes;
            $viewData['perPage'] = $this->perPage;
            $viewData['pageBackground'] = $this->pageBackground;
            $viewData['actions'] = $this->actions;
            $viewData['quickSearch'] = $this->quickSearch;
            return $viewData;
        }


    }
}
