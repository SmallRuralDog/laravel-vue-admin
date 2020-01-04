<template>
  <div v-if="attrs">
    <component :is="attrs.componentName" :attrs="attrs" @change="onChange" />
  </div>
</template>
<script>
import Input from "../widgets/Input";
import RadioGroup from "../widgets/RadioGroup";
import Checkbox from "../widgets/Checkbox";
import CheckboxGroup from "../widgets/CheckboxGroup";
export default {
  components: {
    Input,
    RadioGroup,
    Checkbox,
    CheckboxGroup
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