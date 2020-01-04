<template>
  <el-input
    :type="attrs.type"
    :class="attrs.className"
    :maxlength="attrs.maxlength"
    :minlength="attrs.minlength"
    :show-word-limit="attrs.showWordLimit"
    :placeholder="attrs.placeholder"
    :clearable="attrs.clearable"
    :show-password="attrs.showPassword"
    :disabled="attrs.disabled"
    :size="attrs.size"
    :prefix-icon="attrs.prefixIcon"
    :suffix-icon="attrs.suffixIcon"
    :rows="attrs.rows"
    :autosize="attrs.autosize"
    :autocomplete="attrs.autocomplete"
    :readonly="attrs.readonly"
    :max="attrs.max"
    :min="attrs.min"
    :step="attrs.step"
    :resize="attrs.resize"
    :autofocus="attrs.autofocus"
    :form="attrs.form"
    :label="attrs.label"
    :tabindex="attrs.tabindex"
    :validate-event="attrs.validateEvent"
    v-model="vm"
    @input="onChange"
  ></el-input>
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
  },
  data() {
    return {
      vm: ""
    };
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>