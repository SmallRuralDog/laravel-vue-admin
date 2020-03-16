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
          this.$router.push(this.uri);
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
      //替换变量
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
