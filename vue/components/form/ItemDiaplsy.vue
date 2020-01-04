<template>
  <div v-if="attrs">
    <component :is="attrs.name" :attrs="attrs" @change="onChange" />
  </div>
</template>
<script>
import Input from "../widgets/Input";
export default {
  components: {
    Input
  },
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
      this.$emit("change", value);
    }
  }
};
</script>