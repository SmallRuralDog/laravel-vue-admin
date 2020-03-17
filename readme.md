
![laravel-vue-admin-logo](./docs/README.assets/logo-1584436939847.png)

Laravel-Vue-Admin 是一个开箱即用的Laravel后台扩展，前后端分离，后端控制前端组件，前端使用ElementUI



 [中文文档](https://smallruraldog.github.io/laravel-vue-admin/#/)


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

## 说明
项目正在开发中，欢迎体验吐槽