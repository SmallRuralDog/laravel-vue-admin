<template>
  <div :style="attrs.style" :class="attrs.className">
    <div class="layout-page-header" v-if="attrs.showHeader">
      <div class="layout-page-header-title" v-html="attrs.title"></div>
      <div
        class="layout-page-header-description"
        v-html="attrs.description"
      ></div>
    </div>
    <div>
      <component
        v-for="(row, index) in attrs.rows"
        :key="index"
        :is="row.componentName"
        :attrs="row"
        v-bind="$props"
      />
    </div>
  </div>
</template>
<script>
export default {
  props: {
    attrs: Object,
  },
};
</script>
