<template>
  <el-image
    :style="attrs.style"
    :class="attrs.className"
    :fit="attrs.fit"
    :lazy="attrs.lazy"
    :src="value"
    :scroll-container="attrs.scrollContainer"
    :preview-src-list="previewSrcList"
    :z-index="attrs.zIndex"
  />
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    },
    row: Object,
    column_value: {
      default: null
    }
  },
  mounted() {},
  computed: {
    previewSrcList() {
      if (!this.attrs.preview) return [];
      if (this._.isArray(this.column_value)) {
        return this.column_value;
      } else {
        return [this.column_value];
      }
    }
  }
};
</script>
