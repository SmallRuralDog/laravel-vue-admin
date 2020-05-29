<template>
  <div ref="editor" :style="attrs.style" :class="attrs.className"></div>
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
    };
  },
  mounted() {
    this.editor = new E(this.$refs.editor);
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
    this.editor.create();
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
