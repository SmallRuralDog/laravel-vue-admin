<template>
  <el-tooltip
    :effect="attrs.effect"
    :content="attrs.content"
    :placement="attrs.placement"
    :disabled="attrs.disabled"
    :offset="attrs.offset"
    :transition="attrs.transition"
    :visible-arrow="attrs.visibleArrow"
    :open-delay="attrs.openDelay"
    :popper-class="attrs.popperClass"
    :enterable="attrs.enterable"
    :hide-after="attrs.hideAfter"
    :tabindex="attrs.tabindex"
  >
    <component
      v-if="attrs.slot"
      :is="attrs.slot.componentName"
      :attrs="attrs.slot"
    />
  </el-tooltip>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>
