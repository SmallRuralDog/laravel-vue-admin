# 自定义扩展

可以扩展属于自己业务逻辑的组件

## 创建扩展包

执行下面命令，生成一个扩展包 

```bash
php artisan admin:extend name
#使用示例，以下会用这个名称来示例
php artisan admin:extend smallruraldog/miss-meijiu-admin
```

然后会在`Admin/Exends` 下创建一个扩展 `MissMeijiuAdmin`

进入到扩展根目录，就是`MissMeijiuAdmin`这个文件夹

检查你的项目`composer.json`配置文件，记住是项目的，不是扩展包的

```json
{
    //....
    "require": {
        //...
        "smallruraldog/miss-meijiu-admin": "*"
    },
    //...
    "repositories": {
        //....
        "0": {
            "type": "path",
            //请确认好扩展包的路径，要不然回安装失败
            "url": "app/Admin/Extends/MissMeijiuAdmin"
        }
    }
}
```

## 初始化扩展包

```bash
composer update
```

成功后执行

```bash
npm install
```

成功后执行

```base
npm run dev
```

开发模式自动编译

```bash
npm run watch
```

> 注意：如果失败，可能需要执行两次

编译

```bash
npm run production
```



## 目录结构说明

```
- dist //vue编译后的文件目录
- resource //前端文件目录
  - js
    - components //组件
    - extend.js //注册文件
  - sass
    - extend.scss //组件样式
- src
  - components //组件定义类
```

## 创建组件

### 表单字段组件

在 `src/components`下创建一个PHP类

```php
namespace Smallruraldog\MissMeijiuAdmin\Components;

use SmallRuralDog\Admin\Components\Component;
//需要继承 Component
class GoodsSku extends Component
{
    //组件的名称，等下注册vue组件的时候名称需要一致
    protected $componentName = "GoodsSku";
    
    /** 示例属性 *******************************/
    
    //当前所有规格
    protected $goodsAttrs = [];
    //添加规格接口
    protected $addGoodsAttrUrl;
    protected $addGoodsAttrValueUrl;
    protected $uploadComponent;
    protected $imageComponent;
    /*********************************/
    
    //需要隐藏的属性，设置后不会在json中输出
    public $hideAttrs = [];
    
    public function __construct($value = [])
    {
        //字段初始值
        $this->componentValue($this->getValue([]));
        
        /** 示例代码 *******************************/
        $goodsAttrModel = new GoodsAttr();
        $this->goodsAttrs = $goodsAttrModel->allAttrs();
        $this->addGoodsAttrUrl = route("addGoodsAttr");
        $this->addGoodsAttrValueUrl = route("addGoodsAttrValue");
        $this->uploadComponent = Upload::make()->width(130)->height(130);
        $this->imageComponent = Image::make()->size(30, 30)->className("mr-10");
        /*********************************/
    }
    //定义一个make
    public static function make($value = [])
    {
        return new GoodsSku($value);
    }
    
    //自定义字段输出值，在表单编辑时使用
    public function getValue($data)
    {
        return [
            'goods_attrs' => [],
            'goods_sku_list' => []
        ];
    }
}
```

在`resources\js\components`下创建vue文件，例如`GoodsSku.vue`

```vue
<template>
  <!--这是属性示例用法-->
  <el-input
    :style="attrs.style"
    :class="attrs.className"
    :validate-event="attrs.validateEvent"
    :value="value" <!--绑定字段的值-->
    @input="onChange" <!--改变字段的值-->
  >
  </el-input>
</template>
<script>
    export default {
        props: {
            //组件类定义的属性
            attrs: Object,
            //当前表单的所有字段的值
            form_data: Object,
            //当前表单所有的item
            form_items: Array,
            //当前字段的值，注意：不一定的null
            value: {
                default: null
            }
        },
        data() {
            return {
            };
        },
        //上层实现了v-model功能
        model: {
            prop: "value",
            event: "change"
        },
        methods: {
            //改变字段的值
            onChange(value) {
                this.$emit("change", value);
            }
        }
    };
</script>
```

然后在`extend.js`中注册组件

```js
VueAdmin.booting((Vue, router, store) => {
    //....................
    Vue.component("GoodsSku", require('./components/GoodsSku').default),
});
```

在代码中使用组件

```php
$form->item("goods_sku", "产品规格")->displayComponent(GoodsSku::make())
```

### 表格字段组件

### 表格操作组件

### 表格工具栏组件

### Page组件

如果内置的组件无法满足你的需求，那么就需要自定义了

创建组件定义类

```php
class MyPage extends Component
{
    protected $componentName = 'MyPage';
    
    public static function make()
    {
        return new MyPage();
    }
}
```

创建组件vue文件

```vue
<template>

</template>
<script>
    export default {
        props: {
            attrs: Object
        },
    };
</script>
<style lang="scss"></style>
```

调用组件

```php
public function index(Content $content)
{
    $content->body(MyPage::make());
    return $content;
}
```



## 组件通信

由于各个组件需要通信，所以需要监听或触发各种事件

```js
//监听事件
this.$bus.on("EventName",()=>{
})
//触发事件
this.$bus.emit("EventName")
//注销监听
this.$bus.off("EventName")
```



### 编辑数据加载完毕

由于编辑数据是异步加载的，在组件初始化的时候拿不到真正的数据

```js
mounted() {
    this.$bus.on("EditDataLoadingCompleted", () => {
        
    });
},
destroyed() {
    try {
        this.$bus.off("EditDataLoadingCompleted");
    } catch (e) {}
},
```

### 刷新表格

```js
this.$bus.emit("tableReload")
```

更多事件正在开发中......