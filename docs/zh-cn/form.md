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

