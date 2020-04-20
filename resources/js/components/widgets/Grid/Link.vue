<template>
  <el-link
    :effect="attrs.effect"
    :style="attrs.style"
    :type="type"
    :class='attrs.className'
    :underline="attrs.underline"
    :disabled="attrs.disabled"
    :href="attrs.href!==null?attrs.href:value"
    :icon='attrs.icon'
  >{{value}}</el-link>
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
  },
  mounted() {
 
  },
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
    }
  }
};
</script>