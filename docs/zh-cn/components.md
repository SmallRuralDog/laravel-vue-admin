# 内置组件

## 公共方法

每个组件都可以设置`class`和`style`

```php
setClassName('class-1 class-2');
setStyle(['width'=>'100px']);
```

## Tag 标签

```php
Tag::make();
```

### type

默认，会从 success/info/warning/danger 随机显示一个

```php
Tag::make()->setType();
```

#### 指定值

```php
Tag::make()->setType('info');
```

#### 指定随机组

```php
Tag::make()->setType(['info','danger']);
```

#### 指定值对应

```php
Tag::make()->setType(['yes'=>'info','on'=>'danger',1=>'success',0=>'warning']);
```

### 是否可关闭

```php
Tag::make()->setClosable();
```

### 是否禁用渐变动画

```php
Tag::make()->setDisableTransitions();
```

### 是否有边框描边

```php
Tag::make()->setHit();
```

### 尺寸

medium / small / mini

```php
Tag::make()->setSize('mini');
```

### 主题

dark / light / plain

```php
Tag::make()->setEffect('dark');
```

## Link 文字链接

```php
Link::make();
```
### type设置
默认，会从 primary / success / warning / danger / info	随机显示一个
```php
Tag::make()->setType();
//指定值
Tag::make()->setType('info');
//指定随机组
Tag::make()->setType(['info','danger']);
//指定值对应
Tag::make()->setType(['yes'=>'info','on'=>'danger',1=>'success',0=>'warning']);
```
### 是否下划线
```php
Tag::make()->setUnderline();
```
### 是否禁用状态
```php
Tag::make()->setDisabled();
```
### 原生 href 属性
```php
Tag::make()->setHref("http://www.baidu.com");
```
### 图标类名

可直接使用内置 [Icon 图标](https://element.eleme.cn/#/zh-CN/component/icon)，或使用自定义图标
```php
Tag::make()->setIcon('el-icon-platform-eleme');
//OR
Tag::make()->setIcon('iconfont my-icon-name');
```
## Avatar 头像
属性与 [Element Avatar](https://element.eleme.cn/#/zh-CN/component/avatar)相同
```php
Avatar::make();
```
