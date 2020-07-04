<template>
  <el-time-picker
    v-if="attrs.type=='picker'"
    v-model="vm"
    :style="attrs.style"
    :class="attrs.className"
    :readonly="attrs.readonly"
    :disabled="attrs.disabled"
    :editable="attrs.editable"
    :clearable="attrs.clearable"
    :size="attrs.size"
    :placeholder="attrs.placeholder"
    :start-placeholder="attrs.startPlaceholder"
    :end-placeholder="attrs.endPlaceholder"
    :is-range="attrs.isRange"
    :arrow-control="attrs.arrowControl"
    :align="attrs.align"
    :popper-class="attrs.popperClass"
    :picker-options="attrs.pickerOptions"
    :range-separator="attrs.rangeSeparator"
    :value-format="attrs.valueFormat"
    :default-value="attrs.defaultValue"
    :name="attrs.name"
    :prefix-icon="attrs.prefixIcon"
    :clear-icon="attrs.clearIcon"
    :start="attrs.start"
    :end="attrs.end"
    :step="attrs.step"
    :minTime="attrs.minTime"
    :maxTime="attrs.maxTime"
    @change="onChange"
  ></el-time-picker>
  <el-time-select
    v-else
    v-model="vm"
    :style="attrs.style"
    :class="attrs.className"
    :readonly="attrs.readonly"
    :disabled="attrs.disabled"
    :editable="attrs.editable"
    :clearable="attrs.clearable"
    :size="attrs.size"
    :placeholder="attrs.placeholder"
    :start-placeholder="attrs.startPlaceholder"
    :end-placeholder="attrs.endPlaceholder"
    :is-range="attrs.isRange"
    :arrow-control="attrs.arrowControl"
    :align="attrs.align"
    :popper-class="attrs.popperClass"
    :picker-options="attrs.pickerOptions"
    :range-separator="attrs.rangeSeparator"
    :value-format="attrs.valueFormat"
    :default-value="attrs.defaultValue"
    :name="attrs.name"
    :prefix-icon="attrs.prefixIcon"
    :clear-icon="attrs.clearIcon"
    @change="onChange"
  ></el-time-select>
</template>
<script>
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent],
  data() {
    return {
      vm: "",
      init: false
    };
  },
  watch: {
    value(value) {
      if (!this.init) {
        this.vm = value;
        this.init = true;
      }
    }
  }
};
</script>