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
      v-for="(checkbox, index) in attrs.options"
      :key="index"
      :label="checkbox.label"
      :disabled="checkbox.disabled"
      :border="checkbox.border"
      :size="checkbox.size"
      :indeterminate="checkbox.indeterminate"
    >{{ checkbox.title }}</el-checkbox>
  </el-checkbox-group>
</template>
<script>
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent],
  data() {
    return {
      vm: this._.cloneDeep(this.value)
    };
  }
};
</script>
