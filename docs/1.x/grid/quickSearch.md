## 快捷搜索
快捷搜索是除了`filter`之外的另一个表格数据搜索方式，用来快速过滤你想要的数据，开启方式如下：

```php
$grid->quickSearch();
```
这样表头会出现一个搜索框

通过给`quickSearch`方法传入不同的参数，来设置不同的搜索方式，有下面几种使用方法
### Like搜索
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

### 设置搜索框占位符
```php
$grid->quickSearchPlaceholder("占位符文字");
```