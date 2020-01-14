<template>
  <div v-if="attrs">
    <component
      :value="value"
      :is="attrs.componentName"
      :attrs="attrs"
      :form_data="form_data"
      @change="onChange"
    />
  </div>
</template>
<script>
import { getArrayValue } from "../../utils";
export default {
  props: {
    value: {
      default: null
    },
    item: Object,
    form_data: Object
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change"
  },
  computed: {
    attrs() {
      return this.item.component;
    }
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>