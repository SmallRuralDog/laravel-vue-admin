<template>
  <div class="upload-component">
    <div class="upload-images">
      <template v-for="(item, index) in list">
        <div :key="index" class="upload-images-item">
          <el-image
            title="预览图片"
            v-if="attrs.type == 'image'"
            :src="item.url"
            :style="{ width: attrs.width + 'px', height: attrs.height + 'px' }"
            fit="cover"
            class="upload-show-image"
            :preview-src-list="urlList"
          />
          <el-avatar
            v-if="attrs.type == 'file'"
            :size="attrs.width"
            shape="square"
            :title="item.name"
            fit="cover"
            icon="el-icon-document-checked"
          />
          <el-avatar v-else-if="attrs.type == 'avatar'" :size="attrs.width" :src="item.url" />
          <i @click="onDelete(index)" class="mask el-icon-close" title="删除图片"></i>
        </div>
      </template>
    </div>
    <div
      class="upload-block"
      :class="{ 'ml-10': list.length > 0 }"
      v-if="list.length < attrs.limit"
    >
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
          :style="{ width: attrs.width + 'px', height: attrs.height + 'px' }"
        >上传</el-button>
      </el-upload>
    </div>
  </div>
</template>
<script>
import { getFileUrl, getFileName } from "@/utils";
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent],
  data() {
    return {
      data: {
        _token: Admin.token,
        ...this.attrs.data
      },
      fileList: []
    };
  },
  mounted() {},
  destroyed() {},
  methods: {
    onDelete(index) {
      if (this._.isArray(this.value)) {
        let t_value = this._.clone(this.value);
        t_value[index][this.attrs.remove_flag_name] = 1;
        this.onChange(t_value);
      } else {
        this.onChange(null);
      }
    },
    onRemove(file, fileList) {},
    onSuccess(response, file, fileList) {
      if (response.code == 200) {
        if (!this.attrs.multiple) {
          this.onChange(response.data.path);
        } else {
          let t_value = this._.clone(this.value);
          t_value = this._.isArray(t_value) ? t_value : [];
          t_value.push(this.getObject(response.data.path, 0));
          this.onChange(t_value);
        }
      } else {
        this.$message.error(response.message);
      }
    },
    onExceed() {
      this.$message.error("超出上传数量");
    },
    getObject(path, id) {
      let keyName = this.attrs.keyName;
      let valueName = this.attrs.valueName;
      let remove_flag_name = this.attrs.remove_flag_name;
      let obj = {};
      if (keyName != null && valueName != null) {
        obj[keyName] = id;
        obj[valueName] = path;
        obj["name"] = getFileName(path);
        obj[remove_flag_name] = 0;
        return obj;
      } else {
        return path;
      }
    },
    getObjectPath(item) {
      let keyName = this.attrs.keyName;
      let valueName = this.attrs.valueName;
      if (keyName != null && valueName != null) {
        return item[valueName];
      }
      return item;
    },
    getObjectKey(item) {
      let keyName = this.attrs.keyName;
      let valueName = this.attrs.valueName;
      if (keyName != null && valueName != null) {
        return item[keyName];
      }
      return item;
    }
  },
  watch: {},

  computed: {
    list() {
      if (this._.isArray(this.value)) {
        return this.value
          .filter(item => {
            if (item[this.attrs.remove_flag_name]) {
              return item[this.attrs.remove_flag_name] == 0;
            }
            return true;
          })
          .map(item => {
            let itemPath = this.getObjectPath(item);
            return {
              id: this.getObjectKey(item),
              name: getFileName(itemPath),
              path: itemPath,
              url: getFileUrl(this.attrs.host, itemPath)
            };
          });
      } else {
        if (!this.value) return [];
        let itemPath = this.value;
        if (this._.isObject()) {
          itemPath = this.getObjectPath(this.value);
        }
        return [
          {
            name: getFileName(itemPath),
            path: itemPath,
            url: getFileUrl(this.attrs.host, itemPath)
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
    .upload-images-item + .upload-images-item {
      margin-left: 10px;
    }
    .upload-images-item {
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
    .upload-show-image {
      border: 1px solid #dcdfe6;
      padding: 2px;
      box-sizing: border-box;
      border-radius: 3px;
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
  }
}
</style>
