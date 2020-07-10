<template>
  <div
    id="base-content"
    element-loading-background="rgba(0, 0, 0, 0)"
  >
    <transition name="fade-transform" mode="out-in">
      <component
        :ref="componentData.componentName"
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
      pathKey: "/",
      query: {},
      loading: false,
      reload: false,
      componentData: {},
    };
  },
  mounted() {
    this.$bus.on("route-after", (to) => {
      this.path = to.path;
      this.query = to.query;
      this.loading = true;

      let queryKey = "";

      _.forEach(this.query, function(value, key) {
        queryKey += key + value;
      });

      this.pathKey = this.path + queryKey;

      this.$store.commit("setPath", this.pathKey);

      if (!this.$store.state.pages[this.pathKey]) {
        this.$store.commit("initPages", this.pathKey);
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
      let componentData = this._.get(this.$store.state.contents, this.pathKey);
      if (componentData && !this.reload) {
        this.componentData = componentData;
        this.loading = false;
        this.reload = false;
      } else {
        this.$Progress.start();
        this.$store
          .dispatch("getCenten", {
            path: this.pathKey,
            contentUrl: window.config.apiRoot + this.path,
            params: {
              ...this.query,
            },
          })
          .then((data) => {
            this.componentData = data;
            this.$Progress.finish();
          })
          .catch(() => {
            this.$Progress.fail();
          })
          .finally(() => {
            this.loading = false;
            this.reload = false;
          });
      }
    },
  },
};
</script>
