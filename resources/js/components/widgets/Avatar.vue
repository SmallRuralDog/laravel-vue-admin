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
import { getFileUrl } from "../../utils";
export default {
  props: {
    attrs: Object,
    row: Object,
    column_value: {
      default: null
    },
    value: {
      default: null
    }
  },
  mounted() {},
  computed: {
    src() {
      return getFileUrl(this.attrs.host, this.value);
    }
  }
};
</script>
