# Laravel-Vue-Admin
## 简介
Laravel-Vue-Admin 是一个开箱即用的Laravel后台扩展，很多地方都参(CTRL)考(V)了 laravel-admin
实现了前后端分离，后端控制前端组件，前端使用ElementUI，目前已实现大部分组件，具体可查看 [使用文档](https://smallruraldog.github.io/laravel-vue-admin/#/)
## 界面预览
![界面预览](https://user-images.githubusercontent.com/5151848/72328488-f55ec800-36ed-11ea-9550-ab10e93e691f.png)

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

## 说明
项目正在开发中，还有很多功能尚未实现，不建议在正式项目使用！欢迎体验吐槽 ~~