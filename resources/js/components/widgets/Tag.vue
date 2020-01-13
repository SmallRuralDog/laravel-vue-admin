<template>
  <el-tag
    :style="attrs.style"
    :class="attrs.className"
    :type="type"
    :closable="attrs.closable"
    :disable-transitions="attrs.disableTransitions"
    :hit="attrs.hit"
    :color="color"
    :size="attrs.size"
    :effect="attrs.effect"
  >{{value}}</el-tag>
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
  },
  mounted() {},
  computed: {
    type() {
      try {
        const data = this.attrs.type.data;
        const random = this.attrs.type.random;
        if (this._.isArray(data)) {
          return random ? this._.sample(data) : data[0];
        } else if (this._.isObject(data)) {
          return data[this.value];
        }
        return data;
      } catch (error) {
        return "";
      }
    },
    color() {
      try {
        const data = this.attrs.color.data;
        const random = this.attrs.color.random;
        if (this._.isArray(data)) {
          return random ? this._.sample(data) : data[0];
        } else if (this._.isObject(data)) {
          return data[this.value];
        }
        return data;
      } catch (error) {
        return "";
      }
    }
  }
};
</script>