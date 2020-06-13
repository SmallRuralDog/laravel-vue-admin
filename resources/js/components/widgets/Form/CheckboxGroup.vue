<template>
  <el-checkbox-group
    :style="attrs.style"
    :class="attrs.className"
    v-model="vm"
    :size="attrs.size"
    :disabled="attrs.disabled"
    :min="attrs.min"
    :max="attrs.max"
    :text-color="attrs.textColor"
    :fill="attrs.fill"
    @change="onChange"
  >
    <el-checkbox
      :style="checkbox.style"
      :class="checkbox.className"
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
      vm: this._.clone(this.value),
    };
  },
  model: {
    prop: "value",
    event: "change"
  },
  watch: {
    value(value) {
      this.vm = value;
    }
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>