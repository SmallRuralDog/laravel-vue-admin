
- [字段使用](#字段使用)
  - [创建字段](#创建字段)
  - [默认值](#默认值)
  - [设置TAB栏](#设置tab栏)
  - [复制其他字段值](#复制其他字段值)
  - [标签的宽度](#标签的宽度)
  - [是否必填](#是否必填)
  - [后端规则](#后端规则)
  - [前端规则](#前端规则)
  - [错误信息](#错误信息)
  - [显示错误信息](#显示错误信息)
  - [行内展示信息](#行内展示信息)
  - [组件的尺寸](#组件的尺寸)
  - [动态显示/隐藏](#动态显示隐藏)
    - [表达式方式](#表达式方式)
  - [忽略空值(留空则不修改)](#忽略空值留空则不修改)
  - [隐藏组件](#隐藏组件)
  - [帮助信息](#帮助信息)
  - [头部/底部组件](#头部底部组件)


## 字段使用

提供各种丰富的表单字段

### 创建字段

``` php
 $form->item('username', '用户名')
```

### 默认值

新增时生效

```php
$form->item()->defaultValue();
```

### 设置TAB栏

用于分割表单字段，默认为`基本信息`


```php
$form->item('username', '用户名')->tab("用户信息");
//注意，要开启tab，必须设置
$form->hideTab(false);
```



### 复制其他字段值

> 编辑时复制其他字段的值，例如在确认密码框时可以用到

``` php
$form->item('password_confirmation', '确认密码')->copyValue('password')

$form->item('password', '密码')->serveRules(['required', 'string', 'min:8', 'confirmed'])
    ->displayComponent(function (){
        return Input::make()->password()->showPassword();
    })
$form->item('password_confirmation', '确认密码')
    ->copyValue('password')
    ->displayComponent(function () {
        return Input::make()->password()->showPassword();
    })
```

### 标签的宽度

``` php
 $form->item('username', '用户名')->labelWidth("120px")
```

### 是否必填

``` php
 $form->item('username', '用户名')->required()
```

### 后端规则

``` php
//通用规则
$form->item('username', '用户名')->serveRules(["required"])
//创建时规则
$form->item('username', '用户名')->serveCreationRules(["required"])
//更新时规则
$form->item('username', '用户名')->serveUpdateRules(["required"])
//自定义验证消息
$form->item('username', '用户名')->serveRulesMessage(["required" => '必填'])
```

### 前端规则

``` php
 $form->item('username', '用户名')->rules([
     ['required' => true, 'message' => '标识必填', 'trigger' => 'blur']
 ])
```

### 错误信息

``` php
 $form->item('username', '用户名')->error("error")
```

### 显示错误信息

``` php
 $form->item('username', '用户名')->showMessage()
```

### 行内展示信息

``` php
 $form->item('username', '用户名')->inlineMessage()
```

### 组件的尺寸

``` php
 $form->item('username', '用户名')->size("small")
```

### 动态显示/隐藏

根据其他字段的值显示或隐藏当前字段

```php
$form->item('username', '用户名')->vif("key","value")
$form->item('username', '用户名')->vif("email",false,true) // 表示填写email任意字符之后才会出现username 注意第二个参数最好不要用null或者可能存在的值
$form->item('username', '用户名')->vif("key.key","value") //支持点操作
```

#### 表达式方式

基于`eval`实现

```php
 $form->item('username', '用户名')->vifEval(function (Form\Utils\VIfEval $eval) {
     //需要监听的字段，必须是数组
     $eval->props(['is_rec', 'is_hot']);
     //表达式字符串
     $eval->functionStr("console.log(this.form_data)");
     //读取js文件，文件地址随意，这个优先级大于functionStr
     $eval->functionPath(admin_path('Script/demo.js'));
 });
```

js表达式模板

建议在`Admin`目录下创建一个`Script`文件夹

```javascript
(function (form_item, form_items, form_data) {
    console.log(form_item,form_items,form_data);
    return true;
})(this.form_item, this.form_items, this.form_data);
//----------可复制上面的代码，下面是说明

//必须返回true或false

//内置lodash对象，可调用所有方法，文档：https://www.html.cn/doc/lodash/
window._
//当前字段属性
form_item
//当前所有表单字段属性
form_items
//当前表单的值
form_data
```



### 忽略空值(留空则不修改)

> 若此字段的值为 ''/null/undefined 或 空对象/空数组 则在提交的表单对象中删除键名

```php
$form->item('password', '密码')->ignoreEmpty()
```

### 隐藏组件

> 有些字段在编辑或创建状态下并不一致需要，配合ignoreEmpty使用效果更佳

```php
## 创建时不输入密码
$form->item('password', '密码')->hiddenMode('create')
$form->item('password', '密码')->hiddenInCreate()

## 编辑时不输入密码
$form->item('password', '密码')->hiddenMode('edit')
$form->item('password', '密码')->hiddenInEdit()
```


### 帮助信息

> 支持 html

``` php
 $form->item('username', '用户名')->help("help content")
```

### 头部/底部组件

会在当前字段上下添加组件，常用于字段内部分块

```php
$form->topComponent(Divider::make("详细信息"))
$form->footerComponent(Divider::make("详细信息"));
```