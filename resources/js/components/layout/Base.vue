<template>
  <div
    id="base-content"
    element-loading-spinner="el-icon-loading"
    element-loading-background="rgba(0, 0, 0, 0)"
  >
    <transition name="fade-transform" mode="out-in">
      <component
        :style="componentData.style"
        :class="componentData.className"
        :is="componentData.componentName"
        :attrs="componentData"
        v-if="!loading"
      />
    </transition>
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
      this.loading = true;

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
      let componentData = this._.get(this.$store.state.contents, this.path);
      if (componentData) {
        this.componentData = componentData;
        this.loading = false;
      } else {
        this.$store
          .dispatch("getCenten", {
            path: this.path,
            contentUrl: window.config.apiRoot + this.path,
            params: {
              ...this.query
            }
          })
          .then(data => {
            this.componentData = data;
            this.loading = false;
          })
          .catch(() => {
            this.loading = false;
          });
      }
    }
  }
};
</script>
