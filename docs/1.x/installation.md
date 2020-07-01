# 安装
---
- [安装环境](#1)
- [开始安装](#2)

<a name="1"></a>
## 安装环境

   - PHP >= 7.1
   - Mysql >= 5.7
   - Laravel 5.5.0 ~ 7.*
   - Fileinfo PHP Extension
 
<a name="2"></a>   
## 开始安装
>{warning} 如果安装过程中出现composer下载过慢或安装失败的情况，请运行命令`composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/`把composer镜像更换为阿里云镜像。

首先需要安装`laravel`，如已安装可以跳过此步骤
```shell script
composer create-project --prefer-dist laravel/laravel 项目名称 7.*
# 或
composer create-project --prefer-dist laravel/laravel 项目名称
```

安装完laravel之后需要设置数据库连接设置正确
```shell script
composer require smallruraldog/laravel-vue-admin
```
然后运行下面的命令来发布资源：
```shell script
php artisan vendor:publish --provider="SmallRuralDog\Admin\AdminServiceProvider"
```
在该命令会生成配置文件`config/admin.php`，可以在里面修改安装的地址、数据库连接、以及表名，建议都是用默认配置不修改。

然后运行下面的命令完成安装：
```shell script
php artisan admin:install
```
启动服务后，在浏览器打开 `http://localhost/admin/` ,使用用户名 `admin` 和密码 `admin`登陆.