<template>
  <div v-if="attrs">
    <component :value="value" :is="attrs.componentName" :attrs="attrs" @change="onChange" />
  </div>
</template>
<script>
export default {
  props: {
    value: {
      default: null
    },
    attrs: Object
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change"
  },
  mounted() {
  },
  watch: {

  },
  methods: {
    onChange(value) {
      console.log(value);
      
      this.$emit("change", value);
    }
  }
};
</script>