# 模型表格

使用[Elememt 的 Table](https://element.eleme.cn/#/zh-CN/component/table)实现，用于展示多条结构类似的数据，可对数据进行排序、筛选、对比或其他自定义操作。

## 使用示例

```php
use SmallRuralDog\Admin\Grid;

$userModel = config('admin.database.users_model');
$grid = new Grid(new $userModel());
$idColumn = $grid->column('id', "ID")->width("100")->sortable();
$nameColumn = $grid->column('name', '用户昵称');
$grid->columns([
    $idColumn,
    $nameColumn
]);
return $grid;
```

## 属性设置

表格的相关属性

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
$grid->size('mini');
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

### TooltipEffect

tooltip effect 属性 。dark/light

```php
$grid->tooltipEffect('dark');
$grid->tooltipEffect('light');
```


### 多选

Table 多选

```php
$grid->selection();
```

### 预加载

更多使用请查看 [Laravel 预加载](https://learnku.com/docs/laravel/6.x/eloquent-relationships/5177#eager-loading)

```php
$grid->with(['roles:id,name', 'roles.permissions', 'roles.menus']);
```

### 默认排序

当前模型的默认排序，不设置为`模型key desc`

```php
$grid->defaultSort('id', 'asc');
```

### 分页

设置 Table 的分页属性，默认`[10, 20, 30, 40, 50, 100]`

#### 每页大小组

```php
$grid->pageSizes([10, 20, 30, 40, 50, 100]);
```

#### 每页大小

默认 20

```php
$grid->perPage(20);
```

#### 背景色

是否为分页按钮添加背景色，默认`false`

```php
$grid->pageBackground();
```

### 隐藏元素/操作
可以隐藏页面上的一些操作
#### 隐藏新建按钮
```php
$grid->hideCreateButton();
```
#### 隐藏行编辑
```php
$grid->hideEditAction();
```
#### 隐藏行删除
```php
$grid->hideDeleteAction();
```


### 快捷搜索
>快捷搜索是除了`filter`之外的另一个表格数据搜索方式，用来快速过滤你想要的数据，开启方式如下：
```php
$grid->quickSearch();
```
这样表头会出现一个搜索框

通过给`quickSearch`方法传入不同的参数，来设置不同的搜索方式，有下面几种使用方法
#### Like搜索
通过设置字段名称来进行简单的`like`查询
```php
$grid->quickSearch('title');
// 提交后模型会执行下面的查询
$model->where('title', 'like', "%{$input}%");
```
多个字段
```php
$grid->quickSearch('title', 'desc', 'content');

// 提交后模型会执行下面的查询

$model->where('title', 'like', "%{$input}%")
    ->orWhere('desc', 'like', "%{$input}%")
    ->orWhere('content', 'like', "%{$input}%");
```
更多用法可查看 [laravel-admin](https://laravel-admin.org/docs/zh/model-grid-quick-search)

#### 设置搜索框占位符
```php
$grid->quickSearchPlaceholder("占位符文字");
```
### 表单搜索

## 字段使用

Table 的数据列

### 创建

共有三个参数

- `prop` 对应列内容的字段名 支持 `.`来获取关联模型字段，需要设置`with`,如`user.name`
- `label` 显示的标题
- `column-key` 数据操作字段名，如排序。默认为`prop`的值

返回`Column`实例

```php
//基本使用
$column = $grid->column('prop', 'label','column-key');
//属性设置
$column = $grid->column('prop', 'label','column-key')->width("100");
```

### 属性

Column 相关属性设置，更多可查看 [Elment Table-column Attributes](https://element.eleme.cn/#/zh-CN/component/table)

#### class

列的 className

```php
$column->className('ClassName ClassName-2');
```

#### LabelClass

当前列标题的自定义类名

```php
$column->labelClassName('ClassName ClassName');
```

#### 宽度

对应列的宽度

```php
$column->width("100");
```

#### 最小宽度

对应列的最小宽度，与 width 的区别是 width 是固定的，min-width 会把剩余宽度按比例分配给设置了 min-width 的列

```php
$column->minWidth("300");
```

#### 固定

列是否固定在左侧或者右侧，true 表示固定在左侧

可选择 `true` `left` `right`

```php
$column->fixed(true);
$column->fixed('left');
$column->fixed('right');
```

#### 排序

对应列是否可以排序

```php
$column->sortable();
```

#### 内容过长

当内容过长被隐藏时显示 tooltip

```php
$column->showOverflowTooltip();
```

#### 对齐方式

可选 `left` `center` `right`

```php
$column->align('left');
$column->align('center');
$column->align('right');
```

#### 表头对齐方式

表头对齐方式，若不设置该项，则使用表格的对齐方式

可选 `left` `center` `right`

```php
$column->headerAlign('left');
$column->headerAlign('center');
$column->headerAlign('right');
```

### 帮助内容
会在列名称右边显示一个问号图标，鼠标放上去会显示设置的内容
```php
$column->help('帮助内容');
```


### 显示组件

列的显示模式，默认显示纯文本形式
使用示例

```php
$column->displayComponent(Tag::make()->size("mini")->type("info"));
```
### 自定义数据
可以在后端自定义当前列的值
- `$row`当前数据行的所有值
- `$value`当前列的值
```php
$grid->column('name')->customValue(function ($row, $value) {
    return $value;
})
```
### 树形列表
>用清晰的层级结构展示信息，可展开或折叠。

此功能必须满足以下几点才能正常使用，暂不支持分页，所以不建议展示大量的数据，后期会加入异步加载

定义一个 `hasMany`管理，名称固定为`children`，并预加载所有`children`，设置好排序
```php
public function children() {
    return $this->hasMany(get_class($this), 'parent_id' )->orderBy('order')->with( 'children' );
}
```
以下代码开启树形展示模式
```php
$grid->tree()
```
开启拖拽排序功能
```php
//自定义拖拽完成接受地址
$grid->tree()->draggable(route('admin.auth.menu.order'))
```
后端会接受到三个参数,可参考以下代码示例
```php
public function menuOrder(Request $request)
{
    try {
        \Admin::validatorData($request->all(), [
            'self' => 'required',//当前节点信息
            'target' => 'required',//目标节点信息
            'type' => ['required', Rule::in(["before", "after", "inner"])],//放置类型  前 后  插入
        ]);

        $self_id = $request->input('self.id');
        $target_id = $request->input('target.id');
        $type = $request->input('type');
        $self_node = Menu::query()->findOrFail($self_id);
        $target_node = Menu::query()->findOrFail($target_id);

        switch ($type) {
            case "before":
                Menu::query()->where('parent_id', $target_node->parent_id)
                    ->where('order', '>=', $target_node->order)
                    ->increment('order');
                $self_node->parent_id = $target_node->parent_id;
                $self_node->order = $target_node->order;
                $self_node->save();
                break;
            case "after":
                Menu::query()->where('parent_id', $target_node->parent_id)
                    ->where('order', '>', $target_node->order)
                    ->increment('order');
                $self_node->parent_id = $target_node->parent_id;
                $self_node->order = $target_node->order + 1;
                $self_node->save();
                break;
            case "inner":
                $self_node->parent_id = $target_node->id;
                $self_node->order = 1;
                $self_node->save();
                break;
        }


    } catch (\Exception $exception) {
        return \Admin::responseError($exception->getMessage());
    }

}

```
### 关联模型
>要成功显示关联模型的值，必须设置`with`的值

要显示关联模型的值，使用`.`来获取关联模型的值，可以多级显示，最后一级为要显示的值
#### 一对一
```php
$grid->with(['permissions']);
$grid->column('permissions.name'),
```
#### 一对多
一对多最终得到的是数组，前端会自动循环展示，文本建议使用`Tag`组件，图片建议使用`Avatar`或`Image`组件
```php
$grid->with(['permissions']);
$grid->column('permissions.name')->displayComponent(Tag::make()->type('info')),
```
### 多级显示
```php
$grid->with(['permissions','permissions.roles','permissions.roles.administrators']);

$grid->column('permissions.name')->displayComponent(Tag::make()->type('info'));

$grid->column('permissions.roles.name')->displayComponent(Tag::make()->type('info'));

$grid->column('permissions.roles.administrators.name')->displayComponent(Tag::make()->type('info'));
```