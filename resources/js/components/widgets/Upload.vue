<template>
  <div>
    <el-upload
      :style="attrs.style"
      :class="attrs.className"
      :action="attrs.action"
      :multiple="attrs.multiple"
      :data="data"
      :show-file-list="false"
      :drag="attrs.drag"
      :accept="attrs.accept"
      list-type="text"
      :disabled="attrs.disabled"
      :limit="attrs.limit"
      :on-exceed="onExceed"
      :on-success="onSuccess"
      :on-remove="onRemove"
    >
      <el-button size="small" type="primary">点击上传</el-button>
    </el-upload>
  </div>
</template>
<script>
import { getFileUrl } from "../../utils";
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
  mounted() {},
  methods: {
    onChange(value) {
      console.log(value);

      this.$emit("change", value);
    },
    onRemove(file, fileList) {
      this.selfList = fileList;
    },
    onSuccess(response, file, fileList) {
      let urls = fileList
        .filter(item => {
          return item.status == "success";
        })
        .map(item => {
          if (item.response) {
            return item.response.data.path;
          } else {
            return item.path;
          }
        });
      if (this.attrs.multiple) {
        this.onChange(urls);
      } else {
        let v = urls.length > 0 ? urls[0] : null;
        this.onChange(v);
      }
    },
    onExceed() {
      this.$Message.error("超出上传数量");
    }
  },
  watch: {
    defaultFileList(val) {
      this.fileList = val.map(item => {
        item.url = getFileUrl(this.attrs.path, item.path);
        return item;
      });
    }
  },

  computed: {
    defaultFileList() {
      if (this._.isArray(this.value)) {
        return this.value.map(item => {
          return {
            name: item,
            path: item,
            url: item
          };
        });
      } else {
        if (!this.value) return [];
        return [
          {
            name: this.value,
            path: this.value,
            url: this.value
          }
        ];
      }
    }
  }
};
</script>
