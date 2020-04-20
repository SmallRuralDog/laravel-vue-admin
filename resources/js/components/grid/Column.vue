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
      let value = this.value;

      if (this.column_attr.itemPrefix) {
        value = this.column_attr.itemPrefix + "" + this.value;
      }
      if (this.column_attr.itemSuffix) {
        value = this.value + "" + this.column_attr.itemSuffix;
      }

      return value;
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
