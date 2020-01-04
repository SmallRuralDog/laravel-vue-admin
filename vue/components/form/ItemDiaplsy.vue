<template>
  <div v-if="attrs">
    <component :is="attrs.componentName" :attrs="attrs" @change="onChange" />
  </div>
</template>
<script>
import Input from "../widgets/Input";
import RadioGroup from "../widgets/RadioGroup";
export default {
  components: {
    Input,
    RadioGroup
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
      console.log(value);

      this.$emit("change", value);
    }
  }
};
</script>