<template>
  <el-row
    :gutter="attrs.gutter"
    :type="attrs.type"
    :justify="attrs.justify"
    :align="attrs.align"
    :tag="attrs.tag"
    :style="attrs.style"
    :class="attrs.className"
  >
    <component
      v-for="(column, index) in attrs.columns"
      :key="index"
      :is="column.componentName"
      :attrs="column"
      v-bind="$props"
    />
  </el-row>
</template>

<script>
export default {
  props: {
    attrs: Object,
  },
};
</script>

<style></style>
