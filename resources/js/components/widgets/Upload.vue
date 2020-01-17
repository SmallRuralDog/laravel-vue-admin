<template>
  <div class="upload-component">
    <div class="upload-images">
      <template v-for="(item,index) in list">
        <div :key="index" class="upload-images-item">
          <el-image
            title="预览图片"
            v-if="attrs.type=='image'"
            :src="item.url"
            :style="{'width':attrs.width+'px','height':attrs.height+'px'}"
            fit="cover"
            :preview-src-list="urlList"
          />
          <el-avatar
            v-if="attrs.type=='file'"
            :size="attrs.width"
            shape="square"
            :title="item.name"
            fit="cover"
            icon="el-icon-document-checked"
          />
          <el-avatar v-else-if="attrs.type=='avatar'" :size="attrs.width" :src="item.url" />
          <i @click="onDelete(index)" class="mask el-icon-close" title="删除图片"></i>
        </div>
      </template>
    </div>
    <div class="upload-block" v-if="list.length<attrs.limit">
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
        :limit="limit"
        :on-exceed="onExceed"
        :on-success="onSuccess"
        :on-remove="onRemove"
      >
        <el-button
          plain
          :class="attrs.type"
          :style="{'width':attrs.width+'px','height':attrs.height+'px'}"
        >上传</el-button>
      </el-upload>
    </div>
  </div>
</template>
<script>
import { getFileUrl, getFileName } from "../../utils";
export default {
  props: ["attrs", "value", "form_data"],
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
      this.$emit("change", value);
    },
    onDelete(index) {
      if (this._.isArray(this.value)) {
        let t_value = this._.clone(this.value);
        t_value.splice(index, 1);
        this.onChange(t_value);
      } else {
        this.onChange(null);
      }
    },
    onRemove(file, fileList) {},
    onSuccess(response, file, fileList) {
      if (!this.attrs.multiple) {
        this.onChange(response.data.path);
      } else {
        let t_value = this._.clone(this.value);
        t_value = this._.isArray(t_value) ? t_value : [];
        t_value.push(response.data.path);
        this.onChange(t_value);
      }
    },
    onExceed() {
      this.$Message.error("超出上传数量");
    }
  },
  watch: {},

  computed: {
    list() {
      if (this._.isArray(this.value)) {
        return this.value.map(item => {
          return {
            name: getFileName(item),
            path: item,
            url: getFileUrl(this.attrs.host, item)
          };
        });
      } else {
        if (!this.value) return [];
        return [
          {
            name: getFileName(this.value),
            path: this.value,
            url: getFileUrl(this.attrs.host, this.value)
          }
        ];
      }
    },
    urlList() {
      return this.list.map(item => {
        return item.url;
      });
    },
    limit() {
      return this.attrs.limit - this.list.length;
    }
  }
};
</script>
<style lang="scss">
.upload-component {
  display: flex;
  flex-wrap: wrap;
  .upload-images {
    display: flex;
    flex-wrap: wrap;
    .upload-images-item {
      margin-right: 10px;
      position: relative;
      line-height: 1;

      img {
        line-height: 1;
        vertical-align: middle;
      }
      .el-image {
        cursor: zoom-in;
      }
      .el-icon-document-checked {
        font-size: 30px;
      }
      .mask {
        position: absolute;
        transition: all 0.3s ease-in-out;
        opacity: 0;
        background: rgba(0, 0, 0, 0.3);
        color: white;
        font-size: 20px;
        padding: 5px;
        top: 50%;
        left: 50%;
        cursor: pointer;
        transform: translate(-50%, -50%);
      }
      &:hover {
        .mask {
          opacity: 1;
        }
      }
    }
  }
  .upload-block {
    .el-upload-dragger {
      width: unset;
      height: unset;
      border: none;
      border-radius: 0;
    }
    .avatar {
      border-radius: 50%;
    }
    .image,
    .file {
      border-radius: 0;
    }
  }
}
</style>