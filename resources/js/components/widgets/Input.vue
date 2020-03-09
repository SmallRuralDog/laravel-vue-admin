<template>
  <el-input
    :style="attrs.style"
    :class="attrs.className"
    :type="attrs.type"
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
    :value="value"
    @input="onChange"
  >
    <template slot="prepend" v-if="attrs.prepend">{{ attrs.prepend }}</template>
    <template slot="append" v-if="attrs.append">{{ attrs.append }}</template>
  </el-input>
</template>
<script>
export default {
  props: ["attrs", "value", "form_data"],
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
