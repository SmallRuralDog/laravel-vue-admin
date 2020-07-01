## 树形列表

>用清晰的层级结构展示信息，可展开或折叠。

此功能必须满足以下几点才能正常使用，暂不支持分页，所以不建议展示大量的数据，后期会加入异步加载

定义一个 `hasMany`管理，名称为`children`，并预加载所有`children`，设置好排序

## 模型的定义
```php
public function children() {
    return $this->hasMany(get_class($this), 'parent_id' )->orderBy('order')->with( 'children' );
}
```
## 以下代码开启树形展示模式
```php
$grid->model()->where('parent_id', 0);//设置查询条件
$grid->tree();//启动树形表格
$grid->rowKey('id');//设置rowKey，必须存在，默认为ID，如果你的Grid没有定义ID字段就要重新设置其他字段
$grid->defaultExpandAll();//默认展开所有行
```