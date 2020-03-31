<template>
  <span>
    <el-popconfirm
      placement="top"
      :title="action.message"
      @onConfirm="onClick"
      v-if="action.message"
    >
      <el-button
        slot="reference"
        :type="action.type"
        :size="action.size"
        :plain="action.plain"
        :round="action.round"
        :circle="action.circle"
        :disabled="action.disabled"
        :icon="action.icon"
        :autofocus="action.autofocus"
        :loading="loading"
        >{{ action.content }}</el-button
      >
    </el-popconfirm>
    <el-tooltip :content="action.tooltip" placement="top" :disabled="!action.tooltip" v-else>
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
    </el-tooltip>
    <el-dialog
      v-if="action.dialog"
      :title="action.dialog.title"
      :visible.sync="dialogTableVisible"
      :width="action.dialog.width"
      :fullscreen="action.dialog.fullscreen"
      :top="action.dialog.top"
      :modal="action.dialog.modal"
      :lock-scroll="action.dialog.lockScroll"
      :custom-class="action.dialog.customClass"
      :show-close="action.dialog.showClose"
      :center="action.dialog.center"
      :close-on-click-modal="action.dialog.closeOnClickModal"
      :close-on-press-escape="action.dialog.closeOnPressEscape"
      append-to-body
      destroy-on-close
    >
      <component
        v-if="action.dialog.slot"
        :is="action.dialog.slot.componentName"
        :attrs="action.dialog.slot"
      />
    </el-dialog>
  </span>
</template>
<script>
export default {
  props: {
    scope: Object, //当前行的字段定义和数据
    action: Object, //当前主键的属性
    key_name: String //主键名称
  },
  data() {
    return {
      loading: false,
      dialogTableVisible: false
    };
  },
  mounted() {
    this.$bus.on("closeDialog", data => {
      this.dialogTableVisible = false;
    });
  },
  destroyed() {
    this.$bus.off("closeDialog");
  },
  methods: {
    onClick() {
      if (this.action.dialog) {
        this.dialogTableVisible = true;
        return;
      }
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
          this.$message.warning("响应类型未定义");
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
