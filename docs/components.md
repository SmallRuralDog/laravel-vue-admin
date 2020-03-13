# 内置组件

## 公共方法

每个组件都可以设置`class`和`style`

```php
className('class-1 class-2');
style(['width'=>'100px']);
```
## 表格组件

### Tag 标签

```php
Tag::make();
```

#### type

默认，会从 success/info/warning/danger 随机显示一个

```php
Tag::make()->type();
```

#### 指定值

```php
Tag::make()->type('info');
```

#### 指定随机组

```php
Tag::make()->type(['info','danger']);
```

#### 指定值对应

```php
Tag::make()->type(['yes'=>'info','on'=>'danger',1=>'success',0=>'warning']);
```

#### 是否可关闭

```php
Tag::make()->closable();
```

#### 是否禁用渐变动画

```php
Tag::make()->disableTransitions();
```

#### 是否有边框描边

```php
Tag::make()->hit();
```

#### 尺寸

medium / small / mini

```php
Tag::make()->size('mini');
```

#### 主题

dark / light / plain

```php
Tag::make()->effect('dark');
```

### Link 文字链接

```php
Link::make();
```
#### type设置
默认，会从 primary / success / warning / danger / info	随机显示一个
```php
Tag::make()->type();
//指定值
Tag::make()->type('info');
//指定随机组
Tag::make()->type(['info','danger']);
//指定值对应
Tag::make()->type(['yes'=>'info','on'=>'danger',1=>'success',0=>'warning']);
```
#### 是否下划线
```php
Tag::make()->underline();
```
#### 是否禁用状态
```php
Tag::make()->disabled();
```
#### 原生 href 属性
```php
Tag::make()->href("http://www.baidu.com");
```
#### 图标类名

可直接使用内置 [Icon 图标](https://element.eleme.cn/#/zh-CN/component/icon)，或使用自定义图标
```php
Tag::make()->icon('el-icon-platform-eleme');
//OR
Tag::make()->icon('iconfont my-icon-name');
```
### Avatar 头像
属性与 [Element Avatar](https://element.eleme.cn/#/zh-CN/component/avatar)相同
```php
Avatar::make();
```
### Image 图片
可显示单张或多张图片，支持大图预览
```php
Image::make();
```
### Icon 图标
```php
Icon::make()
```


### 操作组件

#### ActionButton

可用于vue路由导航，异步请求，连接跳转 操作

```php
ActionButton::make("ActionName")
    ->order(3) //排序 越大越靠前
    ->icon("icon-class-name")//图标
    >handler("route")
    ->uri("WeChat/manage/{app_id}")//路径,{xxx}会被自动替换成当前行的对应值,支持 ?x=x 参数 
//调用代码
$grid->actions(function (Grid\Actions $actions) {
      $actions->add(...);
});
```

### 工具栏组件

#### ToolButton

可用于vue路由导航，异步请求，连接跳转 操作

```php
Grid\Tools\ToolButton::make("同步粉丝")
    ->handler("request") // 类型 request|route|link
    ->uri("") //路径
```

其他属性可参考 `el-button`

## 表单组件

基于element-ui的表单组件实现，基本上所有的组件功能都实现了。使用过程中可查看element-ui的文档，调用的时候`make()->`即可

### Radio 单选框

```php
RadioGroup::make(1, [
	Radio::make(1, "公众号"),
	Radio::make(2, "小程序"),
])
```

### Checkbox 多选框

```php
CheckboxGroup::make()->options([
	Checkbox::make(value,name),
	Checkbox::make(value,name),
]);
```

### Input 输入框

```
Input::make()
```

### InputNumber 计数器

```
InputNumber::make()
```

### Select 选择器

![image-20200313102505193](components.assets/image-20200313102505193.png)

```php
Select::make()
    ->filterable()
    ->options(function () {
        return [
            SelectOption::make(id, name)->avatar("")->desc("")
        ];
})
```

支持远程搜索

```php
Select::make()->filterable()->remote($remoteUrl)
```

### Cascader 级联选择器

当一个数据集合有清晰的层级结构时，可通过级联选择器逐级查看并选择

基础用法

模型导入`ModelTree`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SmallRuralDog\Admin\Traits\ModelTree;

class GoodsClass extends Model
{
    use ModelTree;

    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id')->orderBy('order');
    }
}
```

使用demo

`goods_class_path` 需要设置成json类型

```php
protected $casts = [
	"goods_class_path" => "json"
];
```

```php
$form->item("goods_class_path", "产品分类")->displayComponent(function () {
    $goods_class = new GoodsClass();
    $allNodes = $goods_class->toTree();
    return Cascader::make()->options($allNodes)->value("id")->label("name")->expandTrigger("hover");
}),
```

属性

显示为面板模式

```php
Cascader::make()->panel(true)
```

### Switch 开关

```php
CSwitch::make()
```

### Slider 滑块

```php
Slider::make()
```

### TimePicker 时间选择器

```php
TimePicker::make()
```

### DatePicker 日期选择器

```php
DatePicker::make()
```

### DateTimePicker 日期时间选择器

```php
DateTimePicker::make()
```

### Upload 上传
通过以下的调用来生成上传组件
```php
$form->item('avatar', '头像')->displayComponent(Upload::make()->pictureCard()->avatar()->path('avatar')->uniqueName())
//or
$form->item('avatar', '头像')->displayComponent(function(){
    return Upload::make()->pictureCard()->avatar()->path('avatar')->uniqueName();
})
```
上传地址

自定义上传地址
```php
 Upload::make()->action("http://xxxx")
```
文件URL前缀

如果数据库保存的是相对地址，则这个就是它的URL前面部分。默认为disk的路径
```php
 Upload::make()->host("http://xxxx")
```
支持多文件

支持多个文件上传，数据格式为数组
```php
 Upload::make()->multiple();
//如果是一对多情况下，并且是对象数组，需要指定文件组件,文件路径字段
 Upload::make()->multiple(true,"keyName","valueName");
```
上传附加数据

```php
 Upload::make()->data(['key'=>'value','key_2'=>'value'])
```
保存目录

```php
 Upload::make()->path("path_name")
```
自动生成文件名

默认为上传的文件名
```php
 Upload::make()->uniqueName()
```
拖拽上传

```php
 Upload::make()->drag()
```
文件类型

接受上传的[文件类型](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-accept)
```php
 Upload::make()->accept("xx")
```
文件个数

默认为一个
```php
 Upload::make()->limit(10)
```
禁用

```php
 Upload::make()->disabled()
```
组件类型

支持 `image` `avatar` `file`
```php
 Upload::make()->image()
 Upload::make()->avatar()
 Upload::make()->file()
```
组件大小

组件item的高宽，默认 `100x100`
```php
 Upload::make()->width(150)
 Upload::make()->height(120)
```
### Rate 评分

```
Rate::make()
```

### ColorPicker 颜色选择器

```
ColorPicker::make()
```

### Transfer 穿梭框

```php
Transfer::make()->data($permissionModel::get()->map(function ($item) {
	return TransferData::make($item->id, $item->name);
}))->titles(['可授权', '已授权'])->filterable()
```



