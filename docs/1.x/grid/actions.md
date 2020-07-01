- [行操作](#行操作)
- [定义行操作](#定义行操作)
- [操作栏](#操作栏)
  - [隐藏操作栏](#隐藏操作栏)
  - [最小宽度](#最小宽度)
  - [操作栏固定](#操作栏固定)
  - [操作栏对齐方式](#操作栏对齐方式)
  - [操作栏名称](#操作栏名称)
- [获取当前行的下标](#获取当前行的下标)
- [获取当前行的对象](#获取当前行的对象)
- [隐藏详情操作](#隐藏详情操作)
- [隐藏编辑操作](#隐藏编辑操作)
- [隐藏删除操作](#隐藏删除操作)
- [编辑/删除操作](#编辑删除操作)
- [添加自定义操作](#添加自定义操作)
- [操作组件](#操作组件)
  - [ActionButton](#actionbutton)
  

## 行操作
对当前数据行进行自定义操作，默认有`编辑` `删除`
## 定义行操作
```php
 $grid->actions(function (Grid\Actions $actions) {
    $actions->getRow();//获取当前行的对象，注意是对象不是数组 
 });
```
## 操作栏
操作栏的属性设置
### 隐藏操作栏

```php
$grid->hideActions();
```

### 最小宽度

```php
$grid->actionWidth(180);
```

### 操作栏固定

```php
$grid->actionFixed('right');// left | right
```

### 操作栏对齐方式

```php
$grid->actionAlign('right');//left  right  center
```

### 操作栏名称

```php
$grid->actionLabel('操作');
```
## 获取当前行的下标

```php
 $actions->getKey();
```
## 获取当前行的对象

注意是对象不是数组

```php
$actions->getRow();
//获取ID
$actions->getRow()->id;
```
## 隐藏详情操作

当前版本暂无详情功能

```php
$actions->hideViewAction()
```

## 隐藏编辑操作

```php
$actions->hideEditAction()
```

## 隐藏删除操作

```php
$actions->hideDeleteAction()
```

## 编辑/删除操作

基于el-button实现

```php
$actions->editAction()->disabled(true);//获取编辑操作实例，并置属性
$actions->deleteAction()->message("确定要删除吗，删除不可恢复？");//获取删除操作实例
```

## 添加自定义操作


```php
$actions->add(ActionButton::make("操作名称"));
```
## 操作组件
系统默认提供了一个自定义操作组件
### ActionButton
可用于vue路由导航，异步请求，连接跳转，dialog 操作

创建操作
```php
ActionButton::make("ActionName")
    ->order(3) //排序 越大越靠前
    ->icon("icon-class-name")//图标
    ->message("确认操作提示信息")
    ->tooltip("气泡提示")//无message时生效
    ->handler("route")
    ->uri("WeChat/manage/{app_id}")//路径,{xxx}会被自动替换成当前行的对应值,支持 ?x=x 参数 
    ->dialog(function($dialog){//返回dialog实例
        
    })
```
按钮排序
越大越靠前
```php
ActionButton::make("ActionName")->order(3);
```
设置图片class
```php
ActionButton::make("ActionName")->icon("icon-class-name");
```
设置操作确认提示信息
```php
ActionButton::make("ActionName")->message("确认操作提示信息");
```
设置按钮气泡提示信息
```php
ActionButton::make("ActionName")->tooltip("气泡提示");
```
设置操作事件类型
```php
ActionButton::HANDLER_REQUEST //异步请求
ActionButton::HANDLER_ROUTE //vue路由跳转
ActionButton::HANDLER_LINK //href跳转
ActionButton::make("ActionName")->handler(ActionButton::HANDLER_REQUEST);
```
设置操作uri

关键词替换，`{xxx}` xxx会被替换grid字段的值
```php
ActionButton::make("ActionName")->uri("WeChat/manage/{app_id}");
```
异步请求示例
```php
$url = route("r_name",["p1"=>"v1"]);
ActionButton::make("ActionName")->uri($url);
```
弹出对话框
```php
ActionButton::make("ActionName")->dialog(function(Dialog $dialog){
        
});
```
Dialog代码示例
```php
$actions->add(ActionButton::make("发货")->order(4)->dialog(function (Dialog $dialog) use ($actions) {
    $dialog->title("订单发货")->showClose(false)->width('500px');
    $dialog->slot(function (Content $content) use ($actions) {
        $baseForm = new BaseForm();
        $baseForm->action(route("order-express"));
        $baseForm->emit("closeDialog");
        $baseForm->emit("tableReload");
        $baseForm->addValue("order_no", $actions->getRow()->order_no);
        $baseForm->item("express_company", "物流公司")->required();
        $baseForm->item("express_no", "物流单号")->required();
        $content->row($baseForm);
    });
}));
```
> {info} 这里的Dialog展示的是一个基础表单，当然你可以展示任意 `页面类型组件`