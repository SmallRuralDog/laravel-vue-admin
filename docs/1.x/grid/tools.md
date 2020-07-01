- [工具栏](#工具栏)
- [创建按钮](#创建按钮)
  - [获取按钮对象](#获取按钮对象)
  - [隐藏创建按钮](#隐藏创建按钮)
- [添加自定义工具](#添加自定义工具)
- [组件](#组件)
  - [ToolButton](#toolbutton)


## 工具栏

```php
$grid->toolbars(function (Grid\Toolbars $toolbars) {
	$toolbars->hideCreateButton();
    $toolbars->createButton()->content("添加商品");//获取创建组件实例，修改属性
});
```
## 创建按钮
### 获取按钮对象
详细属性请查看 [ui-button](https://element.eleme.cn/#/zh-CN/component/button) 组件
```php
$toolbars->createButton();
$toolbars->createButton()->message("确认操作提示信息");
$toolbars->createButton()->tooltip("按钮气泡信息");
```
### 隐藏创建按钮
```php
$toolbars->hideCreateButton()
```

## 添加自定义工具

```php
$toolbars->addLeft(ToolButton::make("自定义按钮"));//添加在左侧
$toolbars->addRight(ToolButton::make("自定义按钮"));//添加在右侧
```

## 组件
系统默认提供的操作组件
### ToolButton
详细属性请查看 [ui-button](https://element.eleme.cn/#/zh-CN/component/button) 组件