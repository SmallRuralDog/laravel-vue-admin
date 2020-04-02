# CSS / JavaScript



## 引入CSS文件

如果你需要引入CSS文件，可以在`app/Admin/bootstrap.php`加入下面的代码：

>注意，如果老版本没有`bootstrap.php`，需要手动创建这个文件

```php
Admin::css('/your/css/path/style.css');

Admin::css('https://unpkg.com/element-ui/lib/theme-chalk/index.css');
```

