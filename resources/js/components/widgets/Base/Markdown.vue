<template>
  <mavon-editor
    :style="attrs.style"
    :class="attrs.className"
    :value="attrs.content"
    :editable="false"
    :subfield="false"
    defaultOpen="preview"
    :toolbarsFlag="false"
    :boxShadow="false"
  />
</template>
<script>
import { mavonEditor } from "mavon-editor";
import { BaseComponent } from "@/mixins.js";
import "mavon-editor/dist/css/index.css";
export default {
  components: {
    MavonEditor: mavonEditor,
  },
  mixins: [BaseComponent],
  props: {
    attrs: Object,
  },
};
</script>
