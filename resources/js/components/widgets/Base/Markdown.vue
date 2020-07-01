<template>
  <div>
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
  </div>
</template>
<script>
import { mavonEditor } from "mavon-editor";
import "mavon-editor/dist/css/index.css";
export default {
  components: {
    MavonEditor: mavonEditor,
  },
  props: {
    attrs: Object,
  },
};
</script>
