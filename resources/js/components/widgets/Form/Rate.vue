<template>
  <el-rate
    :value="value"
    :style="attrs.style"
    :class="attrs.className"
    :max="attrs.max"
    :disabled='attrs.disabled'
    :allow-half='attrs.allowHalf'
    :low-threshold='attrs.lowThreshold'
    :high-threshold='attrs.highThreshold'
    :colors='attrs.colors'
    :void-color='attrs.voidColor'
    :icon-classes='attrs.iconClasses'
    :void-icon-class='attrs.voidIconClass'
    :show-text='attrs.showText'
    :show-score='attrs.showScore'
    :text-color='attrs.textColor'
    :texts='attrs.texts'
    @change="onChange"
  ></el-rate>
</template>
<script>
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent]
};
</script>