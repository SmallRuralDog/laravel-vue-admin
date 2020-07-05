<template>
  <div class="wangeditor-main flex-sub">
    <div ref="toolbar" class="toolbar"></div>
    <div v-if="attrs.component">
      <component
        :is="attrs.component.componentName"
        :attrs="attrs.component"
        :editor.sync="editor"
      />
    </div>
    <div ref="editor" :style="attrs.style" :class="attrs.className"></div>
  </div>
</template>
<script>
import E from "wangeditor";
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent],
  data() {
    return {
      editor: null,
      initHtml: false,
      defaultValue: ""
    };
  },
  mounted() {
    this.defaultValue = this._.cloneDeep(this.attrs.componentValue);

    this.editor = new E(this.$refs.toolbar, this.$refs.editor);
    this.editor.customConfig.menus = this.attrs.menus;
    this.editor.customConfig.zIndex = this.attrs.zIndex;
    this.editor.customConfig.uploadImgShowBase64 = this.attrs.uploadImgShowBase64;
    if (this.attrs.uploadImgServer) {
      this.editor.customConfig.uploadImgServer = this.attrs.uploadImgServer;

      this.editor.customConfig.uploadImgParams = {
        _token: Admin.token
      };
    }
    //自定义 fileName
    if (this.attrs.uploadFileName) {
      this.editor.customConfig.uploadFileName = this.attrs.uploadFileName;
    }
    //自定义 header
    if (this.attrs.uploadImgHeaders) {
      this.editor.customConfig.uploadImgHeaders = this.attrs.uploadImgHeaders;
    }

    this.editor.customConfig.onchange = html => {
      this.onChange(html);
    };

    this.$nextTick(() => {
      this.editor.create();
      this.editor.txt.html(this.defaultValue);
    });
    //编辑数据加载完毕设置编辑器的值
    this.$bus.on("EditDataLoadingCompleted", () => {
      this.editor && this.editor.txt.html(this.value);
    });
  },
  destroyed() {
    try {
      this.$bus.off("EditDataLoadingCompleted");
    } catch (e) {}
  }
};
</script>
<style lang="scss" scoped>
.wangeditor-main {
  border: 1px solid #dcdcdc;
  .toolbar {
    background: #f7f7f7;
  }
}
</style>
