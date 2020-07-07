<template>
  <span v-if="componentName == 'default'" v-html="selfValue"></span>
  <component
    v-else
    :is="componentName"
    :value="selfValue"
    :attrs="attrs"
    :row="row"
    :column-value="columnValue"
  />
</template>
<script>
export default {
  props: {
    value: {
      default: null
    },
    columnAttr: Object,
    row: Object,
    columnValue: {
      default: null
    }
  },
  computed: {
    attrs() {
      return this.columnAttr.displayComponentAttrs;
    },
    selfValue() {
      let value = this.value;

      if (this.columnAttr.itemPrefix) {
        value = this.columnAttr.itemPrefix + "" + this.value;
      }
      if (this.columnAttr.itemSuffix) {
        value = this.value + "" + this.columnAttr.itemSuffix;
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
