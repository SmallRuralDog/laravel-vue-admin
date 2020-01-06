<template>
  <div v-if="attrs">
    <component :is="attrs.componentName" :attrs="attrs" @change="onChange" />
  </div>
</template>
<script>

export default {
  props: {
    attrs: Object
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change"
  },
  methods: {
    onChange(value) {
      console.log(value);

      this.$emit("change", value);
    }
  }
};
</script>