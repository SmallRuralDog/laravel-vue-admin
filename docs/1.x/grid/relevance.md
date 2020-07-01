## 关联模型


要显示关联模型的值，使用`.`来获取关联模型的值
### 一对一
```php
$grid->column('permissions.name');
```
### 一对多
一对多最终得到的是数组，前端会自动循环展示，文本建议使用`Tag`组件，图片建议使用`Avatar`或`Image`组件
```php
$grid->column('permissions.name')->component(Tag::make()->type('info'));
```