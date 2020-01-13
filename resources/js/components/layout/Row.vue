<template>
  <el-row :gutter="attrs.gutter">
    <component
      v-for="(column,index) in attrs.columns"
      :key="index"
      :is="column.componentName"
      :attrs="column"
    />
  </el-row>
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
