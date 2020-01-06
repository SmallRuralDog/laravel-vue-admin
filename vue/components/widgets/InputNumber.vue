<template>
  <el-input-number
    v-model="vm"
    :min="attrs.min"
    :max="attrs.max"
    :step="attrs.step"
    :step-strictly="attrs.stepStrictly"
    :precision="attrs.precision"
    :size="attrs.size"
    :disabled="attrs.disabled"
    :controls="attrs.controls"
    :controls-position="attrs.controlsPosition"
    :label="attrs.label"
    :name="attrs.name"
    :placeholder="attrs.placeholder"
    @change="onChange"
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
  data() {
    return {
      vm: 0
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