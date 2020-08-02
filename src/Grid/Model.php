<?php


namespace SmallRuralDog\Admin\Grid;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SmallRuralDog\Admin\Grid;

/**
 * Class Model
 * @package SmallRuralDog\Admin\Grid
 */
class Model
{
    /**
     * Eloquent model instance of the grid model.
     *
     * @var EloquentModel|Builder
     */
    protected $model;


    /**
     * @var EloquentModel |Builder
     */
    protected $sModel;

    /**
     * @var EloquentModel|Builder
     */
    protected $originalModel;

    /**
     * Array of queries of the eloquent model.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $queries;
    /**
     * Sort parameters of the model.
     *
     * @var array
     */
    protected $sort;
    /**
     * @var
     */
    protected $data;
    /**
     * 20 items per page as default.
     * @var int
     */
    protected $perPage = 20;
    /**
     * If the model use pagination.
     *
     * @var bool
     */
    protected $usePaginate = true;

    /**
     * The query string variable used to store the per-page.
     *
     * @var string
     */
    protected $perPageName = 'per_page';

    /**
     * The query string variable used to store the sort.
     *
     * @var string
     */
    protected $sortName = '_sort';

    /**
     * Collection callback.
     *
     * @var \Closure
     */
    protected $collectionCallback;
    /**
     * @var Grid
     */
    protected $grid;

    /**
     * @var Relation
     */
    protected $relation;

    /**
     * @var array
     */
    protected $eagerLoads = [];


    public function __construct(EloquentModel $model = null, Grid $grid = null)
    {
        $this->model = $model;
        $this->sModel = $model;
        $this->originalModel = $model;
        $this->grid = $grid;
        $this->queries = collect();

    }

    public function eloquent()
    {
        return $this->model;
    }

    public function usePaginate($use = true)
    {
        $this->usePaginate = $use;
    }

    /**
     * @return bool
     */
    public function isUsePaginate(): bool
    {
        return $this->usePaginate;
    }


    public function getModel()
    {
        return $this->model;
    }

    protected function findQueryByMethod($method)
    {
        return $this->queries->first(function ($query) use ($method) {
            return $query['method'] == $method;
        });
    }

    protected function resolvePerPage($paginate)
    {
        if ($perPage = request($this->perPageName)) {
            if (is_array($paginate)) {
                $paginate['arguments'][0] = (int)$perPage;

                return $paginate['arguments'];
            }

            $this->perPage = (int)$perPage;
        } else {
            $this->perPage = $this->grid->getPerPage();
        }

        if (isset($paginate['arguments'][0])) {
            return $paginate['arguments'];
        }


        return [$this->perPage];
    }

    /**
     * 设置每页大小
     */
    protected function setPaginate()
    {
        $paginate = $this->findQueryByMethod('paginate');

        $this->queries = $this->queries->reject(function ($query) {
            return $query['method'] == 'paginate';
        });

        if (!$this->usePaginate) {
            $query = [
                'method' => 'get',
                'arguments' => [],
            ];
        } else {
            $query = [
                'method' => 'paginate',
                'arguments' => $this->resolvePerPage($paginate),
            ];
        }

        $this->queries->push($query);
    }


    public function with($relations)
    {
        if (is_array($relations)) {
            if (Arr::isAssoc($relations)) {
                $relations = array_keys($relations);
            }

            $this->eagerLoads = array_merge($this->eagerLoads, $relations);
        }

        if (is_string($relations)) {
            if (Str::contains($relations, '.')) {
                $relations = explode('.', $relations)[0];
            }

            if (Str::contains($relations, ':')) {
                $relations = explode(':', $relations)[0];
            }

            if (in_array($relations, $this->eagerLoads)) {
                return $this;
            }

            $this->eagerLoads[] = $relations;
        }

        return $this->__call('with', (array)$relations);
    }


    /**
     * 设置排序
     */
    protected function setSort()
    {
        $column = request('sort_field', null);
        $sort_field = request('sort_field', null);
        $type = request('sort_order', null);


        if ($sort_field && in_array($type, ['asc', 'desc'])) {
            $this->sort = [
                'column' => $sort_field,
                'type' => $type
            ];
        } else {
            $defaultSort = $this->grid->getDefaultSort();
            $this->sort = [
                'column' => $defaultSort['sort_field'],
                'type' => $defaultSort['sort_order']
            ];
        }


        if (!is_array($this->sort)) {
            return;
        }

        if (empty($this->sort['column']) || empty($this->sort['type'])) {
            return;
        }

        if (Str::contains($this->sort['column'], '.')) {
            $this->setRelationSort($this->sort['column']);

        } else {
            $this->resetOrderBy();

            // get column. if contains "cast", set set column as cast
            if (!empty($this->sort['cast'])) {
                $column = "CAST({$this->sort['column']} AS {$this->sort['cast']}) {$this->sort['type']}";
                $method = 'orderByRaw';
                $arguments = [$column];
            } else {
                $column = $this->sort['column'];
                $method = 'orderBy';
                $arguments = [$column, $this->sort['type']];
            }


            $this->queries->push([
                'method' => $method,
                'arguments' => $arguments,
            ]);
        }
    }

    /**
     * @param $column
     * @throws \Exception
     */
    protected function setRelationSort($column)
    {
        list($relationName, $relationColumn) = explode('.', $column);


        if ($this->queries->contains(function ($query) use ($relationName) {
            return $query['method'] == 'with' && in_array($relationName, $query['arguments']);
        })) {
            $relation = $this->model->$relationName();


            $this->queries->push([
                'method' => 'select',
                'arguments' => [$this->model->getTable() . '.*'],
            ]);


            $this->queries->push([
                'method' => 'join',
                'arguments' => $this->joinParameters($relation),
            ]);

            $this->resetOrderBy();

            $this->queries->push([
                'method' => 'orderBy',
                'arguments' => [
                    $relation->getRelated()->getTable() . '.' . $relationColumn,
                    $this->sort['type'],
                ],
            ]);
        }
    }

    public function resetOrderBy()
    {
        $this->queries = $this->queries->reject(function ($query) {
            return $query['method'] == 'orderBy' || $query['method'] == 'orderByDesc';
        });
    }

    /**
     * @param Relation $relation
     * @return array
     * @throws \Exception
     */
    protected function joinParameters(Relation $relation)
    {
        $relatedTable = $relation->getRelated()->getTable();

        if ($relation instanceof BelongsTo) {
            $foreignKeyMethod = version_compare(app()->version(), '5.8.0', '<') ? 'getForeignKey' : 'getForeignKeyName';


            return [
                $relatedTable,
                $relation->{$foreignKeyMethod}(),
                '=',
                $relatedTable . '.' . $relation->getRelated()->getKeyName(),
            ];
        }

        if ($relation instanceof HasOne) {


            return [
                $relatedTable, function ($join) use ($relation) {
                    $join->on($relation->getQualifiedParentKeyName(), "=", $relation->getQualifiedForeignKeyName())
                        ->where(function (\Illuminate\Database\Query\Builder $query) use ($relation) {
                            collect($relation->getBaseQuery()->wheres)->filter(function ($item) {
                                return $item['value'] ?? false;
                            })->each(function ($item) use ($query) {
                                if ($item['type'] == 'Basic') {
                                    $query->where($item['column'], $item['value']);
                                }

                            });
                        });
                }
            ];
        }

        throw new \Exception('Related sortable only support `HasOne` and `BelongsTo` relation.');
    }

    protected function handleInvalidPage(LengthAwarePaginator $paginator)
    {
        if ($paginator->lastPage() && $paginator->currentPage() > $paginator->lastPage()) {
            $lastPageUrl = \Request::fullUrlWithQuery([
                $paginator->getPageName() => $paginator->lastPage(),
            ]);
        }
    }

    public function addConditions(array $conditions)
    {
        foreach ($conditions as $condition) {
            call_user_func_array([$this, key($condition)], current($condition));
        }

        return $this;
    }

    public function buildData($toArray = false)
    {
        if (empty($this->data)) {
            $this->data = $this->get();
        }
        return $this->data;
    }

    public function displayData($data)
    {
        $columns = $this->grid->getColumns();
        $items = collect();


        foreach ($data as $key => $row) {
            $item = [];

            foreach ($this->grid->getAppendFields() as $field) {
                data_set($item, $field, data_get($row, $field));
            }
            foreach ($columns as $column) {

                if (Str::contains($column->getName(), '.')) {
                    list($relationName, $relationColumn) = explode('.', $column->getName());
                    //如果是集合
                    if (data_get($row, $relationName) instanceof Collection || is_array(data_get($row, $relationName))) {
                        $value = collect(data_get($row, $relationName))->pluck($relationColumn);
                        $c_value = $column->customValueUsing($row, $value);
                        data_set($item, $column->getName(), $c_value);
                    } else {
                        $value = data_get($row, $column->getName(), $column->getDefaultValue());
                        $c_value = $column->customValueUsing($row, $value);
                        data_set($item, $column->getName(), $c_value);
                    }
                } else {
                    $n_value = $column->customValueUsing($row, data_get($row, $column->getName(), $column->getDefaultValue()));
                    data_set($item, $column->getName(), $n_value);
                }
            }
            if (!$this->grid->getHideActions()) {
                data_set($item, 'grid_actions', $this->grid->getActions($row, $key));
            }


            data_set($item, $this->grid->getKeyName(), data_get($row, $this->grid->getKeyName()));

            //如果存在下级
            if ($TreeChildren = data_get($row, $this->grid->getTreeChildrenName())) {
                //递归处理下级列表
                data_set($item, $this->grid->getTreeChildrenName(), $this->displayData($TreeChildren));
            }
            $items->push($item);
        }

        return $items->all();

    }

    public function __call($method, $arguments)
    {

        $this->queries->push([
            'method' => $method,
            'arguments' => $arguments,
        ]);
        return $this;
    }


    public function __get($key)
    {
        $data = $this->buildData();

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
    }


    public function get()
    {

        if ($this->model instanceof LengthAwarePaginator) {
            return $this->model;
        }
        if ($this->relation) {
            $this->model = $this->relation->getQuery();
        }

        $this->setSort();
        $this->setPaginate();


        $this->queries->unique()->each(function ($query) {
            $this->model = call_user_func_array([$this->model, $query['method']], $query['arguments']);
        });


        $data = $this->model;

        if ($this->model instanceof Collection) {
            return $this->displayData($data);
        }

        if ($this->model instanceof LengthAwarePaginator) {
            return [
                'current_page' => $this->model->currentPage(),
                'per_page' => $this->model->perPage(),
                'last_page' => $this->model->lastPage(),
                'total' => $this->model->total(),
                'data' => $this->displayData($data->items())
            ];
        }

    }
}
