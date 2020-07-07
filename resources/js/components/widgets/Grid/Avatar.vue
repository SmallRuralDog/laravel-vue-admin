<template>
  <el-avatar
    :style="attrs.style"
    :class="attrs.className"
    :icon="attrs.icon"
    :size="attrs.size"
    :shape="attrs.shape"
    :src="src"
    :srcSet="attrs.srcSet"
    :alt="attrs.alt"
    :fit="attrs.fit"
  />
</template>
<script>
import { getFileUrl } from "@/utils";
export default {
  props: {
    attrs: Object,
    row: Object,
    columnValue: {
      default: null
    },
    value: {
      default: null
    }
  },
  mounted() {},
  computed: {
    src() {
      if (this.value) {
        return getFileUrl(this.attrs.host, this.value);
      }
      return this.attrs.defaultSrc;
    }
  }
};
</script>
