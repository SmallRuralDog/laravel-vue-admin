<template>
  <span :style="attrs.style" :class="attrs.className" v-html="attrs.html"></span>
</template>
<script>
import { BaseComponent } from "@/mixins.js";
export default {
  mixins: [BaseComponent],
  props: {
    attrs: Object
  }
};
</script>
