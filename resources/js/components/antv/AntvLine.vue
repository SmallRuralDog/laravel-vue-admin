<template>
  <div :id="attrs.canvasId"></div>
</template>
<script>
import { Line } from "@antv/g2plot";
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
    this.antv = new Line(this.attrs.canvasId, {
      data: this.attrs.data,
      ...this.attrs.config
    });
    this.antv.render();
  },
  updated() {
    this.antv.changeData(this.attrs.data);
  },
  destroyed() {
    //this.antv.destory();
  }
};
</script>
