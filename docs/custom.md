# 自定义组件

可以扩展属于自己业务逻辑的组件

## 创建扩展包

执行下面命令，生成一个扩展包 

```bash
php artisan admin:extend name
#使用示例，以下会用这个名称来示例
php artisan admin:extend smallruraldog/miss-meijiu-admin
```

然后会在`Admin/Exends` 下创建一个扩展 `MissMeijiuAdmin`

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
            //请确认好扩展包的路径，要不然会安装失败
            "url": "app/Admin/Extends/MissMeijiuAdmin"
        }
    }
}
```

检查完成后执行

```shell
composer update
```

## 初始化扩展包

注意：先进入到扩展根目录

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

当然你还可以创建你的 路由  控制器  Model 等等，开发出一个具有业务逻辑的扩展

## 自定义组件的理解

由于前后端分离的架构，任何一个组件的实现都是先加载组件定义属性，根据属性渲染组件

可以说一切组件皆对象，所有要实现一个组件就必须有组件定义类（后端），Vue文件（前端）

后端定义好一个组件的 属性，前端根据属性去实现相对应的功能

自定义组件完全没限制，比如你可以使用内置已有的包功能，也可以安装新的包



## 内置已安装的npm包

```json
"devDependencies": {
        "@chenfengyuan/vue-qrcode": "^1.0.2",
        "axios": "^0.19.2",
        "babel-plugin-component": "^1.1.1",
        "babel-plugin-import": "^1.13.0",
        "cross-env": "^5.1",
        "element-ui": "^2.13.0",//UI
        "laravel-mix": "^4.1.4",
        "lodash": "^4.17.15",
        "popper.js": "^1.12",
        "resolve-url-loader": "^2.3.1",
        "sass": "^1.20.1",
        "sass-loader": "7.*",
        "vue": "^2.6.11",
        "vue-bus": "^1.2.1",
        "vue-clipboard2": "^0.3.1",
        "vue-dplayer": "0.0.10",
        "vue-happy-scroll": "^2.1.1",
        "vue-router": "^3.1.6",
        "vue-template-compiler": "^2.6.10",
        "vue-waterfall2": "^1.9.6",
        "wangeditor": "^3.1.1",
        "@antv/g2plot": "^1.0.2",
        "awe-dnd": "^0.3.4",
        "babel-plugin-dynamic-import-webpack": "^1.1.0",
        "babel-plugin-syntax-dynamic-import": "^6.18.0",
        "nprogress": "^0.2.0",
        "url-loader": "^3.0.0",
        "vue-nprogress": "^0.1.5",
        "vuex": "^3.1.3"
}
```



## 创建步骤

创建一个自定义组件需要三部

- 第一步：创建组件定义类

- 第二步：创建Vue组件

- 第三部：注册Vue组件

## 创建组件

### Form字段组件

在 `src/components`下创建一个组件定义类，格式如下，必须继承`SmallRuralDog\Admin\Components\Component`

```php

use SmallRuralDog\Admin\Components\Component;
//需要继承 Component
class MyInput extends Component
{
    //组件的名称，等下注册vue组件的时候名称需要一致
    protected $componentName = "MyInput";

    //需要隐藏的属性，设置后不会在json中输出，这个功能由父类实现
    public $hideAttrs = [];
    
    //定义一个make，这里的$value 是你组件的默认值，类型由你来决定
    public static function make($value=null)
    {
        return new GoodsSku($value);
    }
    
    //自定义字段输出值，在表单编辑时会调用这个方法获取值，如果没定义则使用默认值
    public function getValue($data)
    {
        return $data;
    }
}
```

在`resources\js\components`下创建vue文件，例如`MyInput.vue`



```vue
<template>
  <!--这是属性示例用法,具体要实现什么功能，自由发挥-->
  <el-input
    :style="attrs.style"
    :class="attrs.className"
    :value="value"
    @input="onChange"
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
    Vue.component("MyInput", require('./components/MyInput').default),
});
```

在代码中使用组件

```php
$form->item("goods_sku", "产品规格")->component(MyInput::make())
```

### Grid字段组件

自定义表格展现组件

创建组件定义类，下面以Boole组件为例

![image-20200402153922198](custom.assets/image-20200402153922198.png)

```php
use SmallRuralDog\Admin\Components\Component;

class Boole extends Component
{
    protected $componentName = "Boole";
    public static function make($value = null)
    {
        return new Boole($value);
    }

}
```

创建组件Vue文件

```vue
<template>
  <span>
    <i class="el-icon-success status" v-if="value"></i>
    <i class="el-icon-error status" v-else></i>
  </span>
</template>
<script>
    //引入组件公共定义
    import { GridColumnComponent } from "@/mixins";
    export default {
      	mixins: [GridColumnComponent]//混入
        //..... 你自己的代码
    };
</script>
<style lang="scss" scoped>
    .status {
      font-size: 20px;
    }
    .el-icon-success {
      color: #67c23a;
    }
    .el-icon-error {
      color: #f56c6c;
    }
</style>
```

组件公共部分

```js
const GridColumnComponent = {
    props: {
        attrs: Object,//当前组件的属性，就是你组件定义类的属性
        row: Object,//当前行数据
        column_value: {//字段原始值，接口返回什么这里就是什么
            default: null
        },
        value: {//字段值，经过处理（拼接，计算等）
            default: null
        }
    }
}
```

在`extend.js`注册组件

```js
Vue.component('Boole', require('xxx').default);
```

打包你的组件

```shell
npm run production
```

使用组件

```php
$grid->column('status', "状态")->width(100)->align("center")->component(Boole::make());
```



### Grid操作组件

自定义表格行操作

![image-20200313101225595](custom.assets/image-20200313101225595.png)

> 下面以ActionButton为例

创建一个组件类 继承 `BaseRowAction`

```php
class ActionButton extends BaseRowAction
{
    use Button;//导入Button属性
    
    protected $uri;
    protected $componentName = "ActionButton";
    protected $handler;

    public function __construct($content)
    {
        $this->content = $content;
        $this->type("text");
    }

    /**
     * @param string $content 按钮内容
     * @return ToolButton
     */
    public static function make($content)
    {
        return new ActionButton($content);
    }

    /**
     * @param mixed $uri
     * @return $this
     */
    public function uri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param string $handler 响应类型 request|route|link
     * @return $this
     */
    public function handler($handler)
    {
        $this->handler = $handler;
        return $this;
    }
}
```

创建组件Vue文件

```vue
<template>
  <el-button
    :type="action.type"
    :size="action.size"
    :plain="action.plain"
    :round="action.round"
    :circle="action.circle"
    :disabled="action.disabled"
    :icon="action.icon"
    :autofocus="action.autofocus"
    :loading="loading"
    class="mr-10"
    @click="onClick"
    >{{ action.content }}</el-button
  >
</template>
<script>
export default {
  props: {
    scope: Object,//当前行的字段定义和数据
    action: Object,//当前主键的属性
    key_name: String//主键名称
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    onClick() {
      //判断操作响应类型
      switch (this.action.handler) {
        case "route":
          this.$route.push(this.uri);
          break;
        case "link":
          window.location.href = this.uri;
          break;
        case "request":
          this.onRequest(this.uri);
          break;
        default:
          this.$Message.warning("响应类型未定义");
          break;
      }
    },
    onRequest(uri) {
      this.loading = true;
      this.$http
        .get(uri)
        .then(res => {
          if (res.code == 200) {
          }
        })
        .finally(() => {
          this.loading = false;
        });
    }
  },
  computed: {
    uri() {
      //替换变量 ,新版已经可以在php端获取当前行对象了
      let uri = this.action.uri;
      this._.forEach(this.row, (value, key) => {
        uri = this._.replace(uri, "{" + key + "}", value);
      });
      return uri;
    },
    //当前表格/树形表格的字段定义
    colum() {
      return this.scope.colum;
    },
    //当前行的值
    row() {
      return this.scope.row;
    },
    //主键值
    key() {
      return this.scope.row[this.key_name];
    }
  }
};
</script>
```

注册Vue组件

```js
Vue.component('ActionButton', require('xxx').default);
```

使用自定义组件

```php
$grid->actions(function (Grid\Actions $actions) {
	$actions->add(Grid\Actions\ActionButton::make("公众号管理")->order(3)->handler('route')->uri("WeChat/manage/{app_id}"));
});
```



### Grid工具栏组件

![image-20200313100328876](custom.assets/image-20200313100328876.png)

下面以ToolButton为例

按照国际惯例，创建组件类 继承`BaseAction`

```php
class ToolButton extends BaseAction
{
    use Button;
    protected $uri;
    protected $componentName = "ToolButton";
    protected $handler;

    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @param string $content 按钮内容
     * @return ToolButton
     */
    public static function make($content)
    {
        return new ToolButton($content);
    }

    /**
     * @param mixed $uri
     * @return $this
     */
    public function uri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param string $handler 响应类型 request|route|link
     * @return $this
     */
    public function handler($handler)
    {
        $this->handler = $handler;
        return $this;
    }


}
```

创建vue文件

```vue
<template>
  <el-button
    :type="attrs.type"
    :size="attrs.size"
    :plain="attrs.plain"
    :round="attrs.round"
    :circle="attrs.circle"
    :disabled="attrs.disabled"
    :icon="attrs.icon"
    :autofocus="attrs.autofocus"
    :loading="loading"
    class="mr-10"
    @click="onClick"
    >{{ attrs.content }}</el-button
  >
</template>
<script>
export default {
  props: {
      //组件属性
    attrs: Object
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    onClick() {
      switch (this.attrs.handler) {
        case "route":
          this.$router.push(this.attrs.uri);
          break;
        case "link":
          window.location.href = this.attrs.uri;
          break;
        case "request":
          this.onRequest(this.attrs.uri);
          break;
        default:
          this.$Message.warning("响应类型未定义");
          break;
      }
    },
    onRequest(uri) {
      this.loading = true;
      this.$http
        .get(uri)
        .then(res => {
          if (res.code == 200) {
  
          }
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>
```

注册Vue组件

```js
Vue.component('ToolButton', require('xxx').default);
```

调用组件

```php
$fansListGrid->toolbars(function (Grid\Toolbars $toolbars) use ($app_id) {
    $toolbars->hideCreateButton();
    $toolbars->addRight(Grid\Tools\ToolButton::make("同步粉丝")
                        ->icon("el-icon-refresh")
                        ->type("primary")
                        ->handler("request")
                        ->uri(route("WeChat/syncFans", ['app_id' => $app_id])));
});
```



### 基础组件

基础组件的Vue的props中，只能获取当前组件的属性，没有其他附加的props

> 其实工具栏组件也是基础组件

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

当然，在你自定义的组件中也可以开放事件给其他组件调用

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
this.$bus.emit("tableReload");
```

### 设置表格加载状态

```php
this.$bus.emit("tableSetLoading",true);

this.$bus.emit("tableSetLoading",false);
```

### 刷新内容区域

```php
this.$bus.emit("pageReload");
```

### 关闭Dialog

```php
this.$bus.emit("closeDialog");
```

### 重置表单数据

```php
this.$bus.emit("resetFormData");
```

### 设置Grid弹窗表单

```php
this.$bus.emit("showDialogGridFrom", { isShow: true });
```



更多事件正在开发中......