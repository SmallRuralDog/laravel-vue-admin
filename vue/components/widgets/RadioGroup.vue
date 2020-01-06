<template>
  <el-radio-group v-model="vm" @change="onChange" :style="attrs.style" :class="attrs.className">
    <el-radio
      :style="radio.style"
      :class="radio.className"
      v-for="(radio,index) in attrs.options"
      :key="index"
      :label="radio.label"
      :disabled="radio.disabled"
      :border="radio.border"
      :size="radio.size"
    >{{radio.title}}</el-radio>
  </el-radio-group>
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