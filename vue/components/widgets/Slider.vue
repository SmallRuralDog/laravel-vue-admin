<template>
  <el-slider
    v-model="vm"
    :style="attrs.style"
    :class="attrs.className"
    :min="attrs.min"
    :max="attrs.max"
    :disabled="attrs.disabled"
    :step="attrs.step"
    :show-input="attrs.showInput"
    :show-input-controls="attrs.showInputControls"
    :input-size="attrs.inputSize"
    :show-stops="attrs.showStops"
    :show-tooltip="attrs.showTooltip"
    :range="attrs.range"
    :vertical="attrs.vertical"
    :height="attrs.height"
    :label="attrs.label"
    :tooltip-class="attrs.tooltipClass"
    @change="onChange"
  ></el-slider>
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
      vm: this.attrs.componentValue,
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