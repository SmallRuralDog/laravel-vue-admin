## 全局
### Header右组件
### Header左组件
## 页面
内容区域完全自定义
## 表格
内置表格自定义组件
### 行操作
数据行的操作
### 批量操作
表格批量操作，需要开启`selection`
### 自定义按钮

## 表单
自定义表单组件，如`编辑器`，`图片裁剪`
### 创建扩展
```bash
php artisan admin:form-item {name}

//例如
php artisan admin:form-item smallruraldog/editor
```
### npm初始化
进入扩展根目录：扩展包在`admin-components`目录下
```bash
npm install

npm run watch-poll 
```
如果未编译，重新执行一次`npm run watch-poll `即可

### 开发教程

### 使用扩展
```php
$form->item('content', '内容')->displayComponent(Editor::make())
```

### 编译
```bash
npm run production
```
### 发布到Composer
请自行搜索相关教程，欢迎PR