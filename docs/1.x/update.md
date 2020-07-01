# 版本升级
---

## 更新命令
```shell script
composer update smallruraldog/laravel-vue-admin
```
> {danger} 由于扩展是前后端分离模式，所以升级成功后必须重新发布前端静态资源，并且需要清空浏览器的缓存，如出现前端js报错，可以使用浏览器无痕模式

```shell script
# 更新静态资源命令
php artisan vendor:publish --tag=laravel-vue-admin-assets --force
```

更新语言包
```shell script
php artisan vendor:publish --tag=laravel-vue-admin-lang --force
```

清理视图缓存
```shell script
php artisan view:clear
```

不要忘记清理浏览器缓存