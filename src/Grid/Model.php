<?php


namespace SmallRuralDog\Admin\Grid;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
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


    public function __construct(EloquentModel $model, Grid $grid = null)
    {
        $this->model = $model;
        $this->originalModel = $model;
        $this->grid = $grid;
        $this->queries = collect();

    }

    public function getModel()
    {
        return $this->model;
    }

    /**
     * 设置每页大小
     */
    protected function setPaginate()
    {
        $this->perPage = (int)request('per_page', 10);
    }

    /**
     * 设置预加载
     */
    protected function setWith()
    {
        $with = $this->grid->getWiths();
        $this->model = $this->model->with($with);
    }

    /**
     * 设置排序
     */
    protected function setSort()
    {
        $sort_prop = request('sort_prop', null);
        $sort_order = request('sort_order', null);
        if ($sort_prop && in_array($sort_order, ['asc', 'desc'])) {
            $this->model = $this->model->orderBy($sort_prop, $sort_order);
        } else {

            $defaultSort = $this->grid->getDefaultSort();

            $this->model = $this->model->orderBy($defaultSort['field'], $defaultSort['order']);
        }
    }

    /**
     * @param bool $toArray
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function buildData($toArray = false)
    {
        if (empty($this->data)) {
            $collection = $this->get();
        }
        $this->data = $collection;
        return $this->data;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get()
    {
        $this->setWith();
        $this->setSort();
        $this->setPaginate();
        return $this->model->paginate($this->perPage);

    }
}
