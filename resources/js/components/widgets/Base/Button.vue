<template>
  <span>
    <el-popconfirm
      placement="top"
      :title="attrs.message"
      @onConfirm="onClick"
      v-if="attrs.message"
    >
      <el-button
        :style="attrs.style"
        :class="attrs.className"
        slot="reference"
        :type="attrs.type"
        :size="attrs.size"
        :plain="attrs.plain"
        :round="attrs.round"
        :circle="attrs.circle"
        :disabled="attrs.disabled"
        :icon="attrs.icon"
        :autofocus="attrs.autofocus"
        :loading="loading"
      >
        <template v-if="attrs.content">{{ attrs.content }}</template>
      </el-button>
    </el-popconfirm>
    <el-tooltip
      :content="attrs.tooltip"
      placement="top"
      :disabled="!attrs.tooltip"
      v-else-if="attrs.tooltip"
    >
      <el-button
        :style="attrs.style"
        :class="attrs.className"
        :type="attrs.type"
        :size="attrs.size"
        :plain="attrs.plain"
        :round="attrs.round"
        :circle="attrs.circle"
        :disabled="attrs.disabled"
        :icon="attrs.icon"
        :autofocus="attrs.autofocus"
        :loading="loading"
        @click="onClick"
      >
        <template v-if="attrs.content">{{ attrs.content }}</template>
      </el-button>
    </el-tooltip>
    <el-button
      v-else
      :style="attrs.style"
      :class="attrs.className"
      :type="attrs.type"
      :size="attrs.size"
      :plain="attrs.plain"
      :round="attrs.round"
      :circle="attrs.circle"
      :disabled="attrs.disabled"
      :icon="attrs.icon"
      :autofocus="attrs.autofocus"
      :loading="loading"
      @click="onClick"
    >
      <template v-if="attrs.content">{{ attrs.content }}</template>
    </el-button>
    <el-dialog
      v-if="attrs.dialog"
      :ref="attrs.dialog.ref || 'dialog'"
      :title="attrs.dialog.title"
      :visible.sync="dialogTableVisible"
      :width="attrs.dialog.width"
      :fullscreen="attrs.dialog.fullscreen"
      :top="attrs.dialog.top"
      :modal="attrs.dialog.modal"
      :lock-scroll="attrs.dialog.lockScroll"
      :custom-class="attrs.dialog.customClass"
      :show-close="attrs.dialog.showClose"
      :center="attrs.dialog.center"
      :close-on-click-modal="attrs.dialog.closeOnClickModal"
      :close-on-press-escape="attrs.dialog.closeOnPressEscape"
      append-to-body
      destroy-on-close
    >
      <component
        v-if="attrs.dialog.slot"
        :is="attrs.dialog.slot.componentName"
        :attrs="attrs.dialog.slot"
      />
    </el-dialog>
  </span>
</template>
<script>
import { BaseComponent } from "@/mixins.js";
export default {
  props: {
    attrs: Object,
  },
  mixins: [BaseComponent],
  data() {
    return {
      loading: false,
      dialogTableVisible: false,
    };
  },
  mounted() {
    this.$bus.on("closeDialog", (data) => {
      this.dialogTableVisible = false;
    });
  },
  destroyed() {
    this.$bus.off("closeDialog");
  },
  methods: {
    onClick() {
      if (this.attrs.dialog) {
        this.dialogTableVisible = true;
        return;
      }

      if (this.attrs.refData) {
        this.$bus.emit(this.attrs.refData.ref, {
          data: this.attrs.refData.data,
          self: this,
        });
        return;
      }

      //判断操作响应类型
      switch (this.attrs.handler) {
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
          this.$message.error("响应类型未定义");
          break;
      }
    },
    onRequest(uri) {
      this.loading = true;
      this.beforeEmit();
      this.$http[this.attrs.requestMethod](uri)
        .then((res) => {
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
      this.attrs.beforeEmit.map((item) => {
        this.$bus.emit(item.eventName, item.eventData);
      });
    },
    afterEmit() {
      this.attrs.afterEmit.map((item) => {
        this.$bus.emit(item.eventName, item.eventData);
      });
    },
    successEmit() {
      this.attrs.successEmit.map((item) => {
        this.$bus.emit(item.eventName, item.eventData);
      });
    },
  },
  computed: {
    uri() {
      //替换变量
      let uri = this.attrs.uri;
      return uri;
    },
  },
};
</script>
