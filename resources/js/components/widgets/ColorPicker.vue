<template>
  <el-color-picker
    :value="value"
    :style="attrs.style"
    :class="attrs.className"
    :disabled="attrs.disabled"
    :size="attrs.size"
    :show-alpha="attrs.showAlpha"
    :color-format="attrs.colorFormat"
    :popper-class="attrs.popperClass"
    :predefine="attrs.predefine	"
    @change="onChange"
  ></el-color-picker>
</template>
<script>
export default {
  props: ["value", "attrs", "form_data", "form_items"],
  model: {
    prop: "value",
    event: "change"
  },
  data() {
    return {};
  },
  mounted() {},

  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>