<template>
  <el-switch
    :value="value"
    :style="attrs.style"
    :class="attrs.className"
    :disabled="attrs.disabled"
    :width="attrs.width"
    :active-icon-class="attrs.activeIconClass"
    :inactive-icon-class="attrs.inactiveIconClass"
    :active-text="attrs.activeText"
    :inactive-text="attrs.inactiveText"
    :active-value="attrs.activeValue"
    :inactive-value="attrs.inactiveValue"
    :active-color="attrs.activeColor"
    :inactive-color="attrs.inactiveColor"
    :name="attrs.name"
    :validate-event="attrs.validateEvent"
    @change="onChange"
  ></el-switch>
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: true
    }
  },
  data() {
    return {
      options: this.attrs.options
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
