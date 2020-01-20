<template>
  <div :style="attrs.style" :class="attrs.className">FormItem</div>
</template>
<script>
export default {
  props: ["value", "attrs", "form_data", "form_items"],
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
