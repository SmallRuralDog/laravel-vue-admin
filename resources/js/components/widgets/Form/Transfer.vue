<template>
  <el-transfer
    :value="value?value:[]"
    :style="attrs.style"
    :class="attrs.className"
    :data="attrs.data"
    :filterable="attrs.filterable"
    :filter-placeholder="attrs.filterPlaceholder"
    :target-order="attrs.targetOrder"
    :titles="attrs.titles"
    :button-texts="attrs.buttonTexts"
    :left-default-checked="attrs.leftDefaultChecked"
    :right-default-checked="attrs.rightDefaultChecked"
    @change="onChange"
  ></el-transfer>
</template>
<script>
import { FormItemComponent } from "@/mixins.js";
export default {
  mixins: [FormItemComponent]
};
</script>