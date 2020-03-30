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
        v-loading="reload"
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
      reload: false,
      componentData: {}
    };
  },
  mounted() {
    this.$bus.on("route-after", to => {
      this.path = to.path;
      this.query = to.query;
      this.loading = true;

      this.$store.commit("setPath", this.path);

      if (!this.$store.state.pages[this.path]) {
        this.$store.commit("initPages", this.path);
      }
      this.$nextTick(() => {
        this.getContent();
      });
    });

    this.$bus.on("pageReload", () => {
      this.reload = true;
      this.getContent();
    });
  },
  destroyed() {
    this.$bus.off("route-after");
    this.$bus.off("pageReload");
  },
  methods: {
    getContent() {
      let componentData = this._.get(this.$store.state.contents, this.path);
      if (componentData && !this.reload) {
        this.componentData = componentData;
        this.loading = false;
        this.reload = false;
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
          })
          .catch(() => {})
          .finally(() => {
            this.loading = false;
            this.reload = false;
          });
      }
    }
  }
};
</script>
