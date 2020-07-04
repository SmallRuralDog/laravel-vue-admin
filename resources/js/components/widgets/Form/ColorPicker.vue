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
import {FormItemComponent} from '@/mixins.js'
export default {
  mixins:[FormItemComponent],
};
</script>