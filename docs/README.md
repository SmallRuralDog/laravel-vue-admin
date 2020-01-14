# Laravel-Vue-Admin
## 简介
Laravel-Vue-Admin 是一个开箱即用的Laravel后台扩展，很多地方都参考了 laravel-admin 和 Nova

## 安装
首先确保安装好了laravel，并且数据库连接设置正确。
``` bash
$ composer require smallruraldog/laravel-vue-admin
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