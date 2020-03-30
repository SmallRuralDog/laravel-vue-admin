<template>
  <span
    :style="attrs.style"
    :class="attrs.className"
    v-html="attrs.html"
  ></span>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>
