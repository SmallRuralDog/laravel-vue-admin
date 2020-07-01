# 表格基本使用
---
表格前端是基于`element-ui`的`Table 表格`实现的，具体可查看 [官方文档](https://element.eleme.cn/#/zh-CN/component/table)


## 简单示例

生成模型与数据库迁移文件
```shell script
php artisan make:model Models\\Movie -m
```
编辑`database\migrations\2020_xx_xx_xx_create_movies_table.php`文件
```php
class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string("title")->comment("标题");
            $table->string("cover")->comment("封面");
            $table->string("describe")->comment("描述");
            $table->tinyInteger("rate")->comment("评分");
            $table->boolean("released")->default(true)->comment("发布");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
```
执行迁移
```shell script
php artisan migrate
```
在`app\Admin\Controllers`创建控制器`MovieController`

```php
namespace App\Admin\Controllers;
use App\Models\Movie;
use Illuminate\Support\Str;
use SmallRuralDog\Admin\Components\Grid\Boole;
use SmallRuralDog\Admin\Components\Grid\Image;
use SmallRuralDog\Admin\Controllers\AdminController;
use SmallRuralDog\Admin\Grid;

class MovieController extends AdminController
{

    public function grid()
    {
        $grid = new Grid(new Movie());
        $grid->column('id', 'ID')->sortable();
        $grid->column('title', '标题');
        $grid->column('cover', '封面')->component(Image::make()->size(70, 100));
        $grid->column('describe', '描述')->customValue(function ($row, $value) {
            return Str::limit($value, 50);
        });
        $grid->column('rate', '评分');
        $grid->column('released', '发布')->component(Boole::make());
        return $grid;
    }

    public function form($isEdit = false)
    {

    }
}
```
在`app\Admin\routes.php`注册路由
```php
<?php

use Illuminate\Routing\Router;

Route::group([
    'domain'=>config('admin.route.domain'),
    'prefix' => config('admin.route.api_prefix'),
    'namespace'=>config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    .....
    $router->resource('movies','MovieController');
});
```
浏览器访问`http://你的域名/admin#/movies`


## 表格属性
表格对象属性

### 高度

Table 的高度，默认为自动高度。如果 height 为 number 类型，单位 px；如果 height 为 string 类型，则这个高度会设置为 Table 的 style.height 的值，Table 的高度会受控于外部样式。

```php
$grid->height('500px');
$grid->height(500);
```
### 最大高度

Table 的最大高度。合法的值为数字或者单位为 px 的高度。

```php
$grid->maxHeight('500px');
$grid->maxHeight(500);
```
### 斑马纹

是否为斑马纹 table

```php
$grid->stripe();
$grid->stripe(true);
$grid->stripe(false);
```
### 纵向边框

是否带有纵向边框

```php
 $grid->border();
 $grid->border(true);
 $grid->border(false);
```
### 尺寸

Table 的尺寸

可选择 `medium` `small` `mini`

```php
$grid->size('medium');
$grid->size('small');
$grid
```
### 宽度是否自撑开

列的宽度是否自撑开

```php
$grid->fit();
$grid->fit(true);
$grid->fit(false);
```
### 显示表头

是否显示表头

```php
$grid->showHeader();
$grid->showHeader(true);
$grid->showHeader(false);
```
### 高亮当前行

是否要高亮当前行

```php
$grid->highlightCurrentRow();
$grid->highlightCurrentRow(false);
```
### 空数据

空数据时显示的文本内容，只支持纯文本

```php
$grid->emptyText("暂无数据");
```
### 多选

Table 多选

```php
$grid->selection();
```
### 默认排序

当前模型的默认排序，不设置为`模型key desc`

```php
$grid->defaultSort('id', 'asc');
```
### 数据状态保存

把数据存入vuex，默认为不保存

```php
$grid->dataVuex();
```
### 分页区间

设置 Table 的分页属性，默认`[10, 20, 30, 40, 50, 100]`


```php
$grid->pageSizes([10, 20, 30, 40, 50, 100]);
```
### 每页大小

默认 20，如果需要不分页，可把perPage设置一个很大的数

```php
$grid->perPage(20);
```
### 分页背景色

是否为分页按钮添加背景色，默认`false`

```php
$grid->pageBackground();
```