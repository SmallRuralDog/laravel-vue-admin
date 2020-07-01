

- [组件属性](#组件属性)
- [创建列](#创建列)
- [排序](#排序)
- [宽度](#宽度)
- [最小宽度](#最小宽度)
- [固定](#固定)
- [内容对齐方式](#内容对齐方式)
- [表头对齐方式](#表头对齐方式)
- [帮助内容](#帮助内容)
- [设置默认值](#设置默认值)
- [class](#class)
  

## 组件属性
数据列相关属性设置，具体可查看 [Elment Table-column Attributes](https://element.eleme.cn/#/zh-CN/component/table)

## 创建列
共有三个参数

- `prop` 对应列内容的字段名 支持 `.`来获取关联模型字段，需要设置`with`,如`user.name`
- `label` 显示的标题
- `column-key` 数据操作字段名，如排序。默认为`prop`的值

返回`Column`实例
```php
$grid->column('id', 'ID');
```

## 排序

是否可以排序

```php
$grid->column('id', 'ID')->sortable();
```
## 宽度

对应列的宽度

```php
$grid->column('id', 'ID')->width("100");
```

## 最小宽度

对应列的最小宽度，与 width 的区别是 width 是固定的，min-width 会把剩余宽度按比例分配给设置了 min-width 的列

```php
$grid->column('id', 'ID')->minWidth("300");
```

## 固定

列是否固定在左侧或者右侧，true 表示固定在左侧

可选择 `true` `left` `right`

```php
$grid->column('id', 'ID')->fixed(true);
$grid->column('id', 'ID')->fixed('left');
$grid->column('id', 'ID')->fixed('right');
```

## 内容对齐方式

可选 `left` `center` `right`

```php
$grid->column('id', 'ID')->align('left');
$grid->column('id', 'ID')->align('center');
$grid->column('id', 'ID')->align('right');
```
## 表头对齐方式

表头对齐方式，若不设置该项，则使用内容的对齐方式

可选 `left` `center` `right`

```php
$grid->column('id', 'ID')->headerAlign('left');
$grid->column('id', 'ID')->headerAlign('center');
$grid->column('id', 'ID')->headerAlign('right');
```

<a name="帮助内容"></a>
## 帮助内容
会在列名称右边显示一个问号图标，鼠标放上去会显示设置的内容
```php
$grid->column('id', 'ID')->help('帮助内容');
```
<a name="设置默认值"></a>
## 设置默认值

当获取不到字段值的时候显示的内容，默认为`null`

```php
$grid->column('id', 'ID')->defaultValue("-")
```
<a name="class"></a>
## class

列的 className

```php
$grid->column('id', 'ID')->className('ClassName ClassName-2');
```