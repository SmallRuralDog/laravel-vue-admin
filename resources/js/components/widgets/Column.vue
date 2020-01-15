<template>
  <span v-if="componentName == 'default'">{{ value }}</span>
  <component
    v-else
    :is="componentName"
    :value="value"
    :attrs="attrs"
    :row="row"
    :column_value="column_value"
  />
</template>
<script>
export default {
  props: {
    value: {
      default: null
    },
    column_attr: Object,
    row: Object,
    column_value: {
      default: null
    }
  },
  computed: {
    attrs() {
      return this.column_attr.displayComponentAttrs;
    },
    componentName() {
      try {
        return this.attrs.componentName;
      } catch (error) {
        return "default";
      }
    }
  }
};
</script>
