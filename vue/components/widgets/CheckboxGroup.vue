<template>
  <el-checkbox-group v-model="vm" @change="onChange">
    <el-checkbox
      v-for="(checkbox,index) in attrs.options"
      :key="index"
      :label="checkbox.label"
      :disabled="checkbox.disabled"
      :border="checkbox.border"
      :size="checkbox.size"
      :indeterminate="checkbox.indeterminate"
    >{{checkbox.title}}</el-checkbox>
  </el-checkbox-group>
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
    return {
      vm: []
    };
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