<template>
  <el-card
    :ref="attrs.ref || 'card'"
    :style="attrs.style"
    :class="attrs.className"
    :body-style="attrs.bodyStyle"
    :shadow="attrs.shadow"
  >
    <div slot="header" class="clearfix">
      <component
        v-if="attrs.header"
        :is="attrs.header.componentName"
        :attrs="attrs.header"
        v-bind="$attrs"
      />
    </div>
    <component
      v-if="attrs.content"
      :is="attrs.content.componentName"
      :attrs="attrs.content"
      v-bind="$attrs"
    />
  </el-card>
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
