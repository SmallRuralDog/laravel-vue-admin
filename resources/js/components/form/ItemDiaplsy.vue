<template>
  <div v-if="attrs">
    <component
      :value="value"
      :is="attrs.componentName"
      :attrs="attrs"
      :form_data="form_data"
      :form_items="form_items"
      @change="onChange"
    />
  </div>
</template>
<script>
import { BaseComponent } from "@/mixins.js";
import { getArrayValue } from "../../utils";
export default {
  mixins: [BaseComponent],
  props: {
    value: {
      default: null,
    },
    form_items: Array,
    //fromItem数据
    form_item: Object,
    //当前表单数据
    form_data: Object,
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change",
  },
  computed: {
    attrs() {
      return this.form_item.component;
    },
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    },
  },
};
</script>
