<template>
  <span v-if="componentName=='default'">{{value}}</span>
  <component v-else :is='componentName' :value="value" :attrs="attrs"/>
</template>
<script>

export default {
  props: {
    value: {
      default: null
    },
    column_attr: Object
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