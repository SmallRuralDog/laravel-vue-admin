<template>
  <el-alert
    :ref="attrs.ref || 'alert'"
    :style="attrs.style"
    :class="attrs.className"
    :title="attrs.title"
    :type="attrs.type"
    :description="attrs.description"
    :closable="attrs.closable"
    :center="attrs.center"
    :close-text="attrs.closeText"
    :show-icon="attrs.showIcon"
    :effect="attrs.effect"
  />
</template>
<script>
import { BaseComponent } from "@/mixins.js";

export default {
  mixins: [BaseComponent],
  props: {
    attrs: Object,
  },
};
</script>
