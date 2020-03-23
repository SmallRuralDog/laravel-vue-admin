![logo](README.assets/logo-1584436939847.png)

Laravel-Vue-Admin 是一个开箱即用的Laravel后台扩展

## 安装
首先确保安装好了laravel，并且数据库连接设置正确。

``` bash
composer require smallruraldog/laravel-vue-admin
```

然后运行下面的命令来发布资源：
``` bash
php artisan vendor:publish --provider="SmallRuralDog\Admin\AdminServiceProvider"
```
在该命令会生成配置文件`config/admin.php`，可以在里面修改安装的地址、数据库连接、以及表名，建议都是用默认配置不修改。
然后运行下面的命令完成安装：

``` bash
php artisan admin:install
```
启动服务后，在浏览器打开 `/admin` ,使用用户名 admin 和密码 admin登录.
## 开始使用
下面是一个简单使用的代码示例



创建资源控制器 继承`AdminController`，并实现`AdminResource`

```php
use SmallRuralDog\Admin\Controllers\AdminController;
use SmallRuralDog\Admin\Controllers\AdminResource;

class GroupBuyController extends AdminController implements AdminResource
{

    //表格定义
    public function grid()
    {
        $grid = new Grid(new GroupBuyGoods());
        $grid->column('goodsSku.image', '产品')->align("center")->component(Image::make()->size(50, 50))->width(70);
        $grid->column('goodsSku.name', ' ');
        $grid->column('group_buy_number', '几人团')->width(90)->align('center');
        $grid->column('group_buy_price', '拼团价格')->width(90)->align('center')->itemPrefix("￥");
        $grid->column('start_time', '开始时间')->width(190);
        $grid->column('end_time', '结束时间')->width(190);
        return $grid;
    }

    //表单定义
    public function form($isEdit = false)
    {
        $form = new Form(new GroupBuyGoods());
        $form->item('name', '拼团标题');
        $form->item('goods_sku_id', "产品")->required()->component(Select::make()->style(['width' => '500px'])->filterable()->remote(route("seckillGoods/searchGoodsSku")));
        $form->item('group_buy_number', "几人团")->required()->component(InputNumber::make(2)->min(2));
        $form->item('group_buy_price', "拼团价格")->required()->component(InputNumber::make()->precision(2)->controls(false));
        $form->item('start_time', "开始时间")->required()->component(DateTimePicker::make());
        $form->item('end_time', "结束时间")->required()->component(DateTimePicker::make());
        return $form;
    }
}
```
注册路由
```php
 $router->resource('GroupBu', 'GroupBuyController');
```
添加菜单，菜单的Uri和注册的路由`GroupBu`一样

## 版本升级

### 查看当前版本
```bash
composer show smallruraldog/laravel-vue-admin
```
### 更新到最新版
```bash
composer require smallruraldog/laravel-vue-admin
```
### 更新到开发版
```bash
composer require smallruraldog/laravel-vue-admin:dev-master
```
### 更新资源文件



```sh
// 更新静态资源文件（必须）
php artisan vendor:publish --tag=laravel-vue-admin-assets --force
```



```bash

// 强制发布语言包文件（非必须）
php artisan vendor:publish --tag=laravel-vue-admin-lang --force

// 清理视图缓存（非必须）
php artisan view:clear
```
最后不要忘记清理浏览器缓存 `ctrl+f5`



# 交流

![image-20200313103804881](README.assets/image-20200313103804881.png)

# 打赏

如果你觉得 Laravel-Vue-Admin 节省了你的开发时间，让你少加班，让你能更早的回家陪女友或者打游戏，能让你更快速的挣到钱，那么请支持我，让我能继续的将 Laravel-Vue-Admin 做好，做下去！



![image-20200313112129545](README.assets/image-20200313112129545.png)