<template>
  <el-transfer
    :value="value?value:[]"
    :style="attrs.style"
    :class="attrs.className"
    :data="attrs.data"
    :filterable="attrs.filterable"
    :filter-placeholder="attrs.filterPlaceholder"
    :target-order="attrs.targetOrder"
    :titles="attrs.titles"
    :button-texts="attrs.buttonTexts"
    :left-default-checked="attrs.leftDefaultChecked"
    :right-default-checked="attrs.rightDefaultChecked"
    @change="onChange"
  ></el-transfer>
</template>
<script>
export default {
  props: {
    attrs: Object,
    form_data:Object,
    value: {
      default: []
    }
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