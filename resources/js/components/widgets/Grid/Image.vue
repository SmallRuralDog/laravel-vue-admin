<template>
  <el-image
    :style="attrs.style"
    :class="attrs.className"
    :fit="attrs.fit"
    :lazy="attrs.lazy"
    :src="src"
    :scroll-container="attrs.scrollContainer"
    :preview-src-list="previewSrcList"
  />
</template>
<script>
import { getFileUrl } from "@/utils";
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    },
    row: Object,
    columnValue: {
      default: null
    }
  },
  mounted() {},
  computed: {
    src() {
      return getFileUrl(this.attrs.host, this.value);
    },
    previewSrcList() {
      if (!this.attrs.preview) return [];
      if (this._.isArray(this.columnValue)) {
        return this.columnValue.map(item => {
          return getFileUrl(this.attrs.host, item);
        });
      } else {
        return [getFileUrl(this.attrs.host, this.columnValue)];
      }
    }
  }
};
</script>
