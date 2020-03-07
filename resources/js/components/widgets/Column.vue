<template>
  <span v-if="componentName == 'default'" v-html="selfValue"></span>
  <component
    v-else
    :is="componentName"
    :value="selfValue"
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
    selfValue() {
      return this.column_attr.itemPrefix + this.value + this.column_attr.itemSuffix;
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
