<template>
  <el-checkbox
    :value="value"
    :style="attrs.style"
    :class="attrs.className"
    :label="attrs.label"
    :true-label="attrs.label"
    :disabled="attrs.disabled"
    :border="attrs.border"
    :size="attrs.size"
    :indeterminate="attrs.indeterminate"
    @change="onChange"
    >{{ attrs.title }}</el-checkbox
  >
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change"
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>
