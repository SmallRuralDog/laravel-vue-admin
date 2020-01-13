<template>
  <el-avatar
    :style="attrs.style"
    :class="attrs.className"
    :icon="attrs.icon"
    :size="attrs.size"
    :shape="attrs.shape"
    :src="value"
    :srcSet="attrs.srcSet"
    :alt="attrs.alt"
    :fit="attrs.fit"
  />
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
  },
  mounted() {},
  computed: {}
};
</script>