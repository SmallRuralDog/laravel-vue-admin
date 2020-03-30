<template>
  <el-card
    :style="attrs.style"
    :class="attrs.className"
    :header="attrs.header"
    :body-style="attrs.bodyStyle"
    :shadow="attrs.shadow"
  >
    <component
      v-if="attrs.content"
      :is="attrs.content.componentName"
      :attrs="attrs.content"
    />
  </el-card>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>
