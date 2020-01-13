<template>
  <span :style="attrs.style" :class="attrs.className">{{attrs.text}}</span>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>