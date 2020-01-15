<template>
  <el-upload
    :style="attrs.style"
    :class="attrs.className"
    :action="attrs.action"
    :multiple="attrs.multiple"
    :data="data"
    :show-file-list="attrs.showFileList"
    :drag="attrs.drag"
    :accept="attrs.accept"
    :list-type="attrs.listType"
    :disabled="attrs.disabled"
    :limit="attrs.limit"
    :file-list="fileList"
    :on-exceed="onExceed"
    :on-success="onSuccess"
    :on-remove="onRemove"
  >
    <el-button size="small" type="primary">点击上传</el-button>
  </el-upload>
</template>
<script>
export default {
  props: ["attrs", "value"],
  data() {
    return {
      data: {
        _token: Admin.token,
        ...this.attrs.data
      },
      fileList: []
    };
  },
  model: {
    prop: "value",
    event: "change"
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    },
    onRemove(file, fileList) {
      this.fileList = fileList;
    },
    onSuccess(response, file, fileList) {
      this.fileList = fileList;
    },
    onExceed() {
      this.$Message.error("超出上传数量");
    }
  },
  watch: {
    defaultFileList(val) {
      this.fileList = val;
    },
    fileList(val) {
      console.log(val);

      let urls = val.map(item => {
        if (item.response) {
          return item.response.data.url;
        } else {
          return item.url;
        }
      });
      if (this.attrs.multiple) {
        this.onChange(urls);
      } else {
        let v = urls.length > 0 ? urls[0] : null;

        this.onChange(v);
      }
    }
  },

  computed: {
    defaultFileList() {
      if (this._.isArray(this.value)) {
        return this.value.map(item => {
          return {
            name: item,
            url: item
          };
        });
      } else {
        if (!this.value) return [];
        return [
          {
            name: this.value,
            url: this.value
          }
        ];
      }
    }
  }
};
</script>
