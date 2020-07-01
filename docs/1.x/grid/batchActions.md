- [批量操作](#批量操作)
- [定义批量操作](#定义批量操作)
  - [获取已选择的KEYS](#获取已选择的keys)
  - [隐藏批量删除操作](#隐藏批量删除操作)
  - [添加自定义批量操作](#添加自定义批量操作)
- [操作组件](#操作组件)
  - [BatchAction](#batchaction)

## 批量操作
批量操作需要设置Grid多选模式

## 定义批量操作
```php
$grid->batchActions(function (Grid\BatchActions $batchActions) {
    $batchActions->hideDeleteAction();//隐藏批量删除操作
    $batchActions->add(...);//添加批量操作
});
```

### 获取已选择的KEYS


> {danger} 注意：获取原理为前段字符串替换，后端无法获取具体值

```php
$batchActions->getKeys();
```

可以在设置`url`时使用

```php
$url = $batchActions->resource . '/' . $batchActions->getKeys();
```

### 隐藏批量删除操作
```php
$batchActions->hideDeleteAction();
```
### 添加自定义批量操作
```php
$batchActions->add(BatchAction::make("加入活动"));
```

## 操作组件
系统默认提供的操作组件
### BatchAction
创建组件
```php
BatchAction::make("ActionName");
```
创建组件
```php
BatchAction::make("ActionName");
```

设置操作确认提示信息
```php
BatchAction::make("ActionName")->message("确认操作提示信息");
```

设置操作uri

```php
BatchAction::make("ActionName")->uri("WeChat/manage/".$batchActions->getKeys());
```
异步请求示例
```php
$url = route("r_name",["keys"=>$batchActions->getKeys()]);
BatchAction::make("ActionName")->($url);
```
设置操作事件类型
```php
BatchAction::HANDLER_REQUEST //异步请求
BatchAction::HANDLER_ROUTE //vue路由跳转
BatchAction::HANDLER_LINK //href跳转
BatchAction::make("ActionName")->handler(BatchAction::HANDLER_REQUEST);
```

弹出对话框
```php
BatchAction::make("ActionName")->dialog(function(Dialog $dialog){
        
});
```

可以在设置`dialog`里的`BaseForm`的`action`时使用

```php
$grid->batchActions(function (BatchActions $batchActions) {
        $batchActions->add(BatchAction::make("加入活动")->dialog(function (Dialog $dialog) use ($batchActions) {
            $dialog->slot(function (Content $content) use ($batchActions) {
            $form = new BaseForm();
            $actionUrl = route('activityJoin', ['keys' => $batchActions->getKeys()]);
            $form->action($actionUrl);
            $form->item('activity_id', '活动');
            $content->row($form);
        });
    }));
});
```
