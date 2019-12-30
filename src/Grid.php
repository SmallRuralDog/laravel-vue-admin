<?php


namespace SmallRuralDog\Admin;


use Closure;
use Illuminate\Database\Eloquent\Model as Eloquent;
use SmallRuralDog\Admin\Grid\Column;
use SmallRuralDog\Admin\Grid\Table\Attributes;
use SmallRuralDog\Admin\Grid\Table\TraitAttributes;

class Grid
{
    use TraitAttributes;

    protected $model;
    /**
     * @var Column[]
     */
    protected $columns = [];
    protected $rows;
    protected $rowsCallback;
    public $columnAttributes = [];
    protected $builder;
    protected $builded = false;
    protected $variables = [];
    protected $resourcePath;
    protected $keyName = 'id';
    protected $exporter;
    protected $view = 'admin::grid.table';
    public $perPages = [10, 20, 30, 50, 100];
    public $perPage = 20;
    protected $renderingCallbacks = [];


    public function __construct(Eloquent $model, Closure $builder = null)
    {
        $this->attributes = new Attributes();
        //$this->model = new Model($model, $this);
        //$this->keyName = $model->getKeyName();
        //$this->builder = $builder;

    }

    /**
     * @param $name
     * @param string $label
     * @return Column
     */
    public function column($name, $label = '')
    {
        return $this->addColumn($name, $label);
    }

    /**
     * @param string $column
     * @param string $label
     * @return Column
     */
    protected function addColumn($column = '', $label = '')
    {
        $column = new Column($column, $label);
        $column->setGrid($this);
        return $column;
    }

    /**
     * @param Column[] $columns
     */
    public function columns($columns)
    {
        $this->columnAttributes = collect($columns)->map(function (Column $column) {
            return $column->getAttributes();
        })->toArray();
    }

    public function render()
    {


        $viewData['columnAttributes'] = $this->columnAttributes;
        $viewData['attributes'] = (array)$this->attributes;

        return view($this->view, $viewData)->render();
    }

}
