<template>
  <el-radio-group
    v-model="vm"
    :style="attrs.style"
    :class="attrs.className"
    @change="onChange"
  >
    <el-radio
      v-for="(radio, index) in attrs.options"
      :style="radio.style"
      :class="radio.className"
      :key="index"
      :label="radio.label"
      :disabled="radio.disabled"
      :border="radio.border"
      :size="radio.size"
      >{{ radio.title }}</el-radio
    >
  </el-radio-group>
</template>
<script>
export default {
  props: {
    attrs: Object,
    form_data: Object,
    value: {
      default: null
    }
  },
  data() {
    return {
      vm: this._.clone(this.value)
    };
  },
  watch: {
    value(value) {
      this.vm = value;
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
