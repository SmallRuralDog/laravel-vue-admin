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

## 表单组件

### Radio 单选框
### Checkbox 多选框
### Input 输入框
### InputNumber 计数器
### Select 选择器
### Cascader 级联选择器
### Switch 开关
### Slider 滑块
### TimePicker 时间选择器
### DatePicker 日期选择器
### DateTimePicker 日期时间选择器
### Upload 上传
通过以下的调用来生成上传组件
```php
$form->item('avatar', '头像')->displayComponent(Upload::make()->pictureCard()->avatar()->path('avatar')->uniqueName())
//or
$form->item('avatar', '头像')->displayComponent(function(){
    return Upload::make()->pictureCard()->avatar()->path('avatar')->uniqueName();
})
```
#### 上传地址
自定义上传地址
```php
 Upload::make()->action("http://xxxx")
```
#### 文件URL前缀
如果数据库保存的是相对地址，则这个就是它的URL前面部分。默认为disk的路径
```php
 Upload::make()->action("http://xxxx")
```
#### 支持多文件
支持多个文件上传，数据格式为数组
```php
 Upload::make()->multiple()
```
#### 上传附加数据
```php
 Upload::make()->data(['key'=>'value','key_2'=>'value'])
```
#### 保存目录
```php
 Upload::make()->path("path_name")
```
#### 自动生成文件名
默认为上传的文件名
```php
 Upload::make()->uniqueName()
```
#### 拖拽上传

```php
 Upload::make()->drag()
```
#### 文件类型
接受上传的[文件类型](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-accept)
```php
 Upload::make()->accept("xx")
```
#### 文件个数
默认为一个
```php
 Upload::make()->limit(10)
```
#### 禁用
```php
 Upload::make()->disabled()
```
#### 组件类型
支持 `image` `avatar` `file`
```php
 Upload::make()->image()
 Upload::make()->avatar()
 Upload::make()->file()
```
#### 组件大小
组件item的高宽，默认 `100x100`
```php
 Upload::make()->width(150)
 Upload::make()->height(120)
 ```
### Rate 评分
### ColorPicker 颜色选择器
### Transfer 穿梭框