<template>
  <component
    :style="componentData.style"
    :class="componentData.className"
    :is="componentData.componentName"
    :attrs="componentData"
    v-if="!loading"
  />
</template>
<script>
export default {
  data() {
    return {
      path: "/",

      loading: false,
      componentData: {}
    };
  },
  mounted() {
    this.$bus.on("route-after", to => {
      this.path = to.path;
      this.$nextTick(() => {
        this.getContent();
      });
    });
  },
  methods: {
    getContent() {
      this.loading = true;
      let contentUrl = window.config.apiRoot + this.path;
      this.$http
        .get(contentUrl)
        .then(data => {
          this.componentData = data;
          this.loading = false;
        })
        .catch(() => {
        });
    }
  }
};
</script>