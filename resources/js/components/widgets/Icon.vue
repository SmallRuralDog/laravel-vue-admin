<template>
  <i :style="attrs.style" :class="value" />
</template>
<script>
export default {
  props: {
    attrs: Object,
    row: Object,
    column_value: {
      default: null
    },
    value: {
      default: null
    }
  },
  mounted() {},
  computed: {}
};
</script>