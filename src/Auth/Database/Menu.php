<?php

namespace SmallRuralDog\Admin\Auth\Database;

use Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SmallRuralDog\Admin\Traits\AdminBuilder;
use SmallRuralDog\Admin\Traits\ModelTree;

/**
 * Class Menu.
 *
 * @property int $id
 *
 * @method where($parent_id, $id)
 */
class Menu extends Model
{
    use AdminBuilder, ModelTree {
        ModelTree::boot as treeBoot;
    }

    protected $appends = ['route'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'permission' => 'array',
        'created_at'=>"Y-m-d H:i:s",
        'updated_at'=>"Y-m-d H:i:s",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'order', 'title', 'icon', 'uri', 'permission'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.menu_table'));

        parent::__construct($attributes);
    }

    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id')->orderBy('order')->with('children');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /**
     * A Menu belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $pivotTable = config('admin.database.role_menu_table');

        $relatedModel = config('admin.database.roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'menu_id', 'role_id');
    }

    /**
     * @return array
     */
    public function allNodes(): array
    {
        $connection = config('admin.database.connection') ?: config('database.default');
        $orderColumn = DB::connection($connection)->getQueryGrammar()->wrap($this->orderColumn);

        $byOrder = 'ROOT ASC,' . $orderColumn;

        $query = static::query();

        if (config('admin.check_menu_roles') !== false) {
            $query->with('roles:id,name,slug');
        }

        $all_list = $query->selectRaw('*, ' . $orderColumn . ' ROOT')->orderByRaw($byOrder)->get()->toArray();

        return collect($all_list)->filter(function ($item) {
            return Admin::user()->visible(Arr::get($item, 'roles', [])) && Admin::user()->can(Arr::get($item, 'permission'));
        })->toArray();
    }

    /**
     * determine if enable menu bind permission.
     *
     * @return bool
     */
    public function withPermission()
    {
        return (bool)config('admin.menu_bind_permission');
    }

    /**
     * Detach models from the relationship.
     *
     * @return void
     */
    protected static function boot()
    {
        static::treeBoot();

        static::deleting(function ($model) {
            $model->roles()->detach();
        });
    }

    public function getRouteAttribute()
    {
        return Str::start($this->uri, '/');
    }

}
