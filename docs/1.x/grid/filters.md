- [表单查询过滤](#表单查询过滤)
- [表单类型](#表单类型)
- [查询类型](#查询类型)
  - [equal](#equal)
  - [not equal](#not-equal)
  - [like](#like)
  - [ilike](#ilike)
  - [contains](#contains)
  - [starts with](#starts-with)
  - [starts with](#starts-with-1)
  - [大于](#大于)
  - [小于](#小于)
  - [between](#between)
  - [in](#in)
  - [notIn](#notin)
  - [date](#date)
  - [day](#day)
  - [month](#month)
  - [year](#year)
  - [where](#where)

## 表单查询过滤
提供了一系列的方法实现表格数据的查询过滤：
```php
$grid->filter(function($filter){
    // 在这里添加字段过滤器
    $filter->like('name', 'name');
    
});
```
## 表单类型

请查看表单可用组件

```php
$filter->between("created_at", "名称")->component(DatePicker::make()->type("daterange"));
```

## 查询类型
目前支持的过滤类型有下面这些:

### equal

`sql: ... WHERE`column`= "$input"`：

```php
$filter->equal('column', $label);
```
### not equal

`sql: ... WHERE`column`!= "$input"`：

```php
$filter->notEqual('column', $label);
```

### like

`sql: ... WHERE`column`LIKE "%$input%"`：

```php
$filter->like('column', $label);
```

### ilike

`sql: ... WHERE`column`ILIKE "%$input%"`：

```php
$filter->ilike('column', $label);
```

### contains

等于like查询

```php
$filter->contains('title');
```

### starts with

查询以输入内容开头的title字段数据

```php
$filter->startsWith('title');
```

### starts with

查询以输入内容结尾的title字段数据

```php
$filter->endsWith('title');
```

### 大于

`sql: ... WHERE`column`> "$input"`：

```php
$filter->gt('column', $label);
```

### 小于

`sql: ... WHERE`column`< "$input"`：

```php
$filter->lt('column', $label);
```

### between

`sql: ... WHERE`column`BETWEEN "$start" AND "$end"`：

```php
$filter->between('column', $label);

// 设置datetime类型
$filter->between('column', $label)->datetime();

// 设置time类型
$filter->between('column', $label)->time();
```

### in

`sql: ... WHERE`column`in (...$inputs)`：

```php
$filter->in('column', $label)->multipleSelect(['key' => 'value']);
```

### notIn

`sql: ... WHERE`column`not in (...$inputs)`：

```php
$filter->notIn('column', $label)->multipleSelect(['key' => 'value']);
```

### date

`sql: ... WHERE DATE(`column`) = "$input"`：

```php
$filter->date('column', $label);
```

### day

`sql: ... WHERE DAY(`column`) = "$input"`：

```php
$filter->day('column', $label);
```

### month

`sql: ... WHERE MONTH(`column`) = "$input"`：

```php
$filter->month('column', $label);
```

### year

`sql: ... WHERE YEAR(`column`) = "$input"`：

```php
$filter->year('column', $label);
```

### where

可以用where来构建比较复杂的查询过滤

`sql: ... WHERE`title`LIKE "%$input" OR`content`LIKE "%$input"`：

```php
$filter->where(function ($query) {

    $query->where('title', 'like', "%{$this->input}%")
        ->orWhere('content', 'like', "%{$this->input}%");

}, 'Text');
```

`sql: ... WHERE`rate`>= 6 AND`created_at`= {$input}`:

```php
$filter->where(function ($query) {

    $query->whereRaw("`rate` >= 6 AND `created_at` = {$this->input}");

}, 'Text');
```

关系查询，查询对应关系`profile`的字段：

```php
$filter->where(function ($query) {

    $query->whereHas('profile', function ($query) {
        $query->where('address', 'like', "%{$this->input}%")->orWhere('email', 'like', "%{$this->input}%");
    });

}, '地址或手机号');
```