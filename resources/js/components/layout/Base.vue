<template>
  <div
    style="min-height:150px;"
    v-loading="loading"
     element-loading-spinner="el-icon-loading"
    element-loading-background="rgba(0, 0, 0, 0)"
  >
    <component
      :style="componentData.style"
      :class="componentData.className"
      :is="componentData.componentName"
      :attrs="componentData"
      v-if="!loading"
    />
  </div>
</template>
<script>
export default {
  data() {
    return {
      path: "/",
      query: {},
      loading: false,
      componentData: {}
    };
  },
  mounted() {
    this.$bus.on("route-after", to => {
      this.path = to.path;
      this.query = to.query;
      this.$nextTick(() => {
        this.getContent();
      });
    });
  },
  destroyed() {
    this.$bus.off("route-after");
  },
  methods: {
    getContent() {
      this.loading = true;
      let contentUrl = window.config.apiRoot + this.path;
      this.$http
        .get(contentUrl, {
          params: {
            ...this.query
          }
        })
        .then(data => {
          this.componentData = data;
          this.loading = false;
        })
        .catch(() => {});
    }
  }
};
</script>
