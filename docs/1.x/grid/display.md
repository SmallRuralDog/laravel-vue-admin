- [自定义数据](#自定义数据)
  - [默认](#默认)
  - [一对一](#一对一)
  - [一对多](#一对多)
- [前缀/后缀](#前缀后缀)
- [组件渲染](#组件渲染)
  - [标签](#标签)
  - [文字链接](#文字链接)
  - [头像](#头像)
  - [图片](#图片)
  - [图标](#图标)
  - [状态](#状态)
  - [评分](#评分)
  

## 自定义数据

可以在后端自定义当前列的值
- `$row`当前数据行的所有值
- `$value`当前列的值

支持HTML标签

### 默认
```php

$grid->column('name')->customValue(function ($row, $value) {
    return "<div>".$value."</div>";
});
```
###  一对一
```php
$grid->column('user.name')->customValue(function ($row, $value) {
    //此时的value是name的值
    return $value;
});
```
### 一对多
```php

$grid->column('roles.name')->customValue(function ($row, $value) {
    //此时的value是 roles.name的值的数组
    //$value= ["name-1","name-2"];
    return $value;
});
```
## 前缀/后缀

会在值的前后以字符串形式拼接

```php
$grid->column('name')->itemSuffix("后面");
$grid->column('name')->itemPrefix("前面");
```
## 组件渲染
列的显示模式，默认显示纯文本形式
```php
$grid->column('id', 'ID')->component(Tag::make()->size("mini")->type("info"));
```
### 标签
```php
Tag::make();
```
类型

```php
Tag::make()->type();
//指定类型
Tag::make()->type('info');
//随机类型
Tag::make()->type(['info','danger']);
//值对应类型
Tag::make()->type(['yes'=>'info','on'=>'danger',1=>'success',0=>'warning']);
```
是否可关闭

```php
Tag::make()->closable();
```

是否禁用渐变动画

```php
Tag::make()->disableTransitions();
```
是否有边框描边

```php
Tag::make()->hit();
```
尺寸

`medium`  `small`  `mini`

```php
Tag::make()->size('mini');
```
主题

`dark` `light`  `plain`

```php
Tag::make()->effect('dark');
```
### 文字链接
将字段值以链接形式渲染
```php
Link::make();
```
type设置
默认，会从 `primary`  `success`  `warning`  `danger`  `info`	随机显示一个
```php
Tag::make()->type();
//指定值
Tag::make()->type('info');
//指定随机组
Tag::make()->type(['info','danger']);
//指定值对应
Tag::make()->type(['yes'=>'info','on'=>'danger',1=>'success',0=>'warning']);
```
是否下划线
```php
Tag::make()->underline();
```
是否禁用状态
```php
Tag::make()->disabled();
```
原生 href 属性
```php
Tag::make()->href("http://www.baidu.com");
```
图标类名

可直接使用内置 [Icon 图标](https://element.eleme.cn/#/zh-CN/component/icon)，或使用自定义图标

详细属性请查看element-ui文档

```php
Tag::make()->icon('el-icon-platform-eleme');
//OR
Tag::make()->icon('iconfont my-icon-name');
```

### 头像
属性与 [Element Avatar](https://element.eleme.cn/#/zh-CN/component/avatar)相同
```php
Avatar::make();
```
设置头像的大小
`number`  `large`  `medium` `small`
```php
Avatar::make()->size('small');
```
设置头像的形状
`circle`  `square`
```php
Avatar::make()->shape('square');
```
### 图片
可显示单张或多张图片，支持大图预览，详细属性请查看element-ui文档
```php
Image::make();
```
### 图标
详细属性请查看element-ui文档

```php
Icon::make()
```
### 状态
```php
Boole::make()
```
### 评分
详细属性请查看element-ui文档
```php
Rate::make()
```