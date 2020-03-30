<template>
  <div :id="attrs.canvasId"></div>
</template>
<script>
import { Column } from "@antv/g2plot";
export default {
  props: {
    attrs: Object
  },
  data() {
    return {
      antv: null
    };
  },
  mounted() {
    this.antv = new Column(this.attrs.canvasId, {
      data: this.attrs.data,
      ...this.attrs.config
    });
    this.antv.render();
  },
  destroyed() {
    //this.antv.destory();
  }
};
</script>
