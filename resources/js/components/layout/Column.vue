<template>
  <el-col
    :span="attrs.width"
    :offset="attrs.offset"
    :push='attrs.push'
    :pull='attrs.pull'
    :tag='attrs.tag'
    :style="attrs.style"
    :class="attrs.className"
  >
    <component
      v-for="(content, index) in attrs.contents"
      :key="index"
      :is="content.componentName"
      :attrs="content"
      v-bind="$props"
    />
  </el-col>
</template>
<script>
export default {
  props: {
    attrs: Object,
  },
};
</script>
