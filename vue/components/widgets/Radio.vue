<template>
  <el-radio
    :label="attrs.label"
    :disabled="attrs.disabled"
    :border="attrs.border"
    :size="attrs.size"
    @change="onChange"
  ></el-radio>
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
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