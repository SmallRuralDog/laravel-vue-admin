<template>
  <el-col :span="attrs.width" :style="attrs.style" :class="attrs.className">
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
    attrs: Object
  }
};
</script>

<style></style>
