- [模型表单](#模型表单)
  - [使用示例](#使用示例)
  - [属性设置](#属性设置)
    - [行内模式](#行内模式)
    - [域标签位置](#域标签位置)
    - [标签宽度](#标签宽度)
    - [标签后缀](#标签后缀)
    - [红色星号](#红色星号)
    - [显示错误信息](#显示错误信息)
    - [行内展示信息](#行内展示信息)
    - [反馈图标](#反馈图标)
    - [触发验证](#触发验证)
    - [组件尺寸](#组件尺寸)
    - [禁用](#禁用)
    - [弹窗模式](#弹窗模式)
    - [创建按钮名称](#创建按钮名称)
    - [更新按钮名称](#更新按钮名称)
    - [取消/返回按钮名称](#取消返回按钮名称)
    - [按钮宽度](#按钮宽度)
  - [全局验证规则](#全局验证规则)



# 模型表单

由输入框、选择器、单选框、多选框等控件组成，用以收集、校验、提交数据

## 使用示例

``` php
$form = new Form(new User());

$form->item('username', '用户名')->component(Input::make()->prefixIcon('el-icon-eleme'));
$form->item('status', '状态')->component(Slider::make(15));

return $form;
```

## 属性设置

表单的相关属性

### 行内模式

``` php
$form->inline();
```

### 域标签位置

> 如果值为 left 或者 right 时，则需要设置 label-width

``` php
$form->labelPosition("right");
```

### 标签宽度

> 例如 '50px'。作为 Form 直接子元素的 form-item 会继承该值。支持 auto

``` php
$form->labelWidth("150px");
```

### 标签后缀

``` php
$form->labelWidth(":");
```

### 红色星号

> 是否显示必填字段的标签旁边的红色星号

``` php
$form->hideRequiredAsterisk(false);
```

### 显示错误信息

> 是否显示校验错误信息

``` php
$form->showMessage(false);
```

### 行内展示信息

> 行内形式展示校验信息

``` php
$form->inlineMessage(true);
```

### 反馈图标

> 是否在输入框中显示校验结果反馈图标

``` php
$form->statusIcon(true);
```

### 触发验证

> 是否在 rules 属性改变后立即触发一次验证

``` php
$form->validateOnRuleChange(true);
```

### 组件尺寸

``` php
$form->size("small");
```

### 禁用

> 是否禁用该表单内的所有组件。若设置为 true，则表单内组件上的 disabled 属性不再生效

``` php
$form->disabled(true);
```

### 弹窗模式

> {info}在Grid中使用

```php
//注意注意注意，在Grid中调用
$grid->dialogForm($this->form()->isDialog());
```

### 创建按钮名称

```php
 $form->createButtonName("创建");
```

### 更新按钮名称

```php
 $form->updateButtonName("更新");
```

### 取消/返回按钮名称

```php
 $form->backButtonName("取消");
```

### 按钮宽度

```php
$form->buttonWidth("200px");
```
## 全局验证规则

会和字段验证规则组合在一起，常用于数组验证

```php
$form->addValidatorRule([
	'goods_sku.goods_sku_list.*.price' => ["numeric", "min:0.01"]
], [
	'goods_sku.goods_sku_list.*.price.min' => '价格最小为0.01'
]);
```