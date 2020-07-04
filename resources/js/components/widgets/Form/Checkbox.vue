<template>
  <el-checkbox
    :value="value"
    :style="attrs.style"
    :class="attrs.className"
    :label="attrs.label"
    :true-label="attrs.label"
    :disabled="attrs.disabled"
    :border="attrs.border"
    :size="attrs.size"
    :indeterminate="attrs.indeterminate"
    @change="onChange"
    >{{ attrs.title }}</el-checkbox
  >
</template>
<script>
import {FormItemComponent} from '@/mixins.js'
export default {
  mixins:[FormItemComponent],
};
</script>
