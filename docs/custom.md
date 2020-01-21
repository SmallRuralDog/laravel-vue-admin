## 全局
### Header右组件
### Header左组件
## 页面
内容区域完全自定义
## 表格
内置表格自定义组件
### 行操作
数据行的操作
#### 生成操作类
暂无命令行创建功能，后面加入
```php
<?php
namespace Admin\Actions;
use SmallRuralDog\Admin\Actions\RowAction;
class Delete extends RowAction
{
    //操作k标识
    public $actionKey = "delete";
    //名称
    public $name = "删除";
    //确认提示，不设置则不提示
    public $confirm = "你确定要删除此条数据吗？";
    //后端处理请求类型
    public $httpMethod = "delete";
    //后端处理请求成功触发事件
    public $emit = "tableReload";

    /**
     * Delete constructor.
     */
    public function __construct()
    {
        //优先级1，前端路由跳转
        $this->vueRoute = $this->getRoutePath() . '/' . $this->getKey() . '/edit';
        //优先级2，后端请求处理
        $this->handleUrl = $this->getResource() . '/' . $this->getKey();
        //优先级3，url跳转
        $this->href = route('xxx');
    }
}
```
#### 使用Action
```php
$grid->addAction(new Delete());
```
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
### 初始化
进入扩展根目录：扩展包在`admin-components`目录下
```bash
npm install
```
### 开发编译
```bash
npm run dev

npm run watch-poll 
```

### 开发教程
可查看我写的一个[demo](https://github.com/SmallRuralDog/wangeditor)，很简单的，一看就会，一写就成！！

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