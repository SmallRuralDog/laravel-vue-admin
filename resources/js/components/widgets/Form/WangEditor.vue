<template>
  <div class="wangeditor-main">
    <div ref="toolbar" class="toolbar"></div>
    <div v-if='attrs.component'>
      <component :is="attrs.component.componentName" :attrs='attrs.component' :editor.sync='editor' />
    </div>
    <div ref="editor" :style="attrs.style" :class="attrs.className"></div>
  </div>
</template>
<script>
import E from "wangeditor";
export default {
  props: ["value", "attrs", "form_data", "form_items"],
  model: {
    prop: "value",
    event: "change",
  },
  data() {
    return {
      editor: null,
      initHtml: false,
      defaultValue: "",
    };
  },
  mounted() {
    this.defaultValue = this._.cloneDeep(this.value);

    this.editor = new E(this.$refs.toolbar, this.$refs.editor);
    this.editor.customConfig.menus = this.attrs.menus;
    this.editor.customConfig.zIndex = this.attrs.zIndex;
    this.editor.customConfig.uploadImgShowBase64 = this.attrs.uploadImgShowBase64;
    if (this.attrs.uploadImgServer) {
      this.editor.customConfig.uploadImgServer = this.attrs.uploadImgServer;

      this.editor.customConfig.uploadImgParams = {
        _token: Admin.token,
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

    this.editor.customConfig.onchange = (html) => {
      this.onChange(html);
    };
    this.$nextTick(() => {
      this.editor.create();
      this.editor.txt.html(this.defaultValue);
    });
  },
  watch: {
    value(html) {
      if (!this.initHtml) {
        this.initHtml = true;
        this.editor.txt.html(html);
      }
    },
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    },
  },
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
