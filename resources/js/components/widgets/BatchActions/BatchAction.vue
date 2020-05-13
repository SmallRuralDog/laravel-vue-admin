<template>
  <a @click="onClick">
    <el-dropdown-item>{{ action.content }}</el-dropdown-item>
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
        :keys='keys'
      />
    </el-dialog>
  </a>
</template>
<script>
export default {
  props: {
    action: Object,
    keys: String
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
      if (this.action.message) {
        this.$confirm(this.action.message, "操作提示").then(() => {
          this.onClickHand();
        });
      } else {
        this.onClickHand();
      }
    },
    onClickHand() {
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
      this.beforeEmit();
      this.$http[this.action.requestMethod](uri)
        .then(res => {
          if (res.code == 200) {
            this.successEmit();
          }
        })
        .finally(() => {
          this.loading = false;
          this.afterEmit();
        });
    },
    beforeEmit() {
      this.action.beforeEmit.map(item => {
        this.$bus.emit(item.eventName, item.eventData);
      });
    },
    afterEmit() {
      this.action.afterEmit.map(item => {
        this.$bus.emit(item.eventName, item.eventData);
      });
    },
    successEmit() {
      this.action.successEmit.map(item => {
        this.$bus.emit(item.eventName, item.eventData);
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

      uri = this._.replace(uri, "selectionKeys", this.keys);

      return uri;
    }
  }
};
</script>
