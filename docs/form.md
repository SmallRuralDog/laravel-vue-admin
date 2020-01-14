# 模型表单

由输入框、选择器、单选框、多选框等控件组成，用以收集、校验、提交数据

## 使用示例

```php
$form = new Form(new User());
$form->items([
    $form->item('username', '用户名')->displayComponent(Input::make()->prefixIcon('el-icon-eleme')),
    $form->item('status', '状态')->displayComponent(Slider::make(15))
]);
return $form;
```

## 属性设置

表单的相关属性

### 行内模式

```php
$form->inline();
```

### 域标签位置

> 如果值为 left 或者 right 时，则需要设置 label-width

```php
$form->labelPosition("right");
```

### 标签宽度

> 例如 '50px'。作为 Form 直接子元素的 form-item 会继承该值。支持 auto

```php
$form->labelWidth("150px");
```

### 标签后缀

```php
$form->labelWidth(":");
```

### 红色星号

> 是否显示必填字段的标签旁边的红色星号

```php
$form->hideRequiredAsterisk(false);
```

### 显示错误信息

> 是否显示校验错误信息

```php
$form->showMessage(false);
```

### 行内展示信息
>行内形式展示校验信息
```php
$form->inlineMessage(true);
```

### 反馈图标

> 是否在输入框中显示校验结果反馈图标

```php
$form->statusIcon(true);
```

### 触发验证
>是否在 rules 属性改变后立即触发一次验证
```php
$form->validateOnRuleChange(true);
```

### 组件尺寸

```php
$form->size("small");
```

### 禁用

> 是否禁用该表单内的所有组件。若设置为 true，则表单内组件上的 disabled 属性不再生效

```php
$form->disabled(true);
```

## 字段使用

提供各种丰富的表单字段

### 创建字段

```php
 $form->item('username', '用户名')
```

### 标签的宽度

```php
 $form->item('username', '用户名')->labelWidth("120px")
```

### 是否必填

```php
 $form->item('username', '用户名')->required()
```

### 后端规则

```php
$form->item('username', '用户名')->serveRules(["required"], ["required" => '必填'])
```

### 前端规则

```php
 $form->item('username', '用户名')->rules([
     ['required' => true, 'message' => '标识必填', 'trigger' => 'blur']
 ])
```

### 错误信息

```php
 $form->item('username', '用户名')->error("error")
```

### 显示错误信息

```php
 $form->item('username', '用户名')->showMessage()
```

### 行内展示信息

```php
 $form->item('username', '用户名')->inlineMessage()
```

### 组件的尺寸

```php
 $form->item('username', '用户名')->size("small")
```

### 帮助信息
>支持 html

```php
 $form->item('username', '用户名')->help("help content")
```
## 表单事件