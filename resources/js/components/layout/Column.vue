<template>
  <el-col :span="attrs.width">
    <component
      v-for="(content,index) in attrs.contents"
      :key="index"
      :is="content.componentName"
      :attrs="content"
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

<style>
</style>
