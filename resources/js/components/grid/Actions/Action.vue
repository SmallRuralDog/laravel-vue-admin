<template>
  <el-popconfirm
    v-if="action.confirm"
    placement="top"
    :title="action.confirm"
    @onConfirm="onHandle"
  >
    <el-button
      slot="reference"
      type="text"
      size="mini"
      :icon="action.icon"
      :loading="loading"
      class="action-button"
    >{{action.name}}</el-button>
  </el-popconfirm>
  <el-button
    v-else
    @click="onHandle"
    type="text"
    size="mini"
    :loading="loading"
    :icon="action.icon"
    class="action-button"
  >{{action.name}}</el-button>
</template>
<script>
export default {
  props: {
    key_name: String,
    action: Object,
    scope: Object
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    onHandle() {
      if (this.vueRoute) {
        this.$router.push(this.vueRoute);
      } else if (this.handleUrl) {
        this.onHandleUrl();
      } else if (this.action.href) {
        window.location.href = this.replaceUrl(this.action.href);
      }
    },
    onHandleUrl() {
      this.loading = true;
      this.$http[this.action.httpMethod](this.handleUrl)
        .then(({ code }) => {
          if (code === 200 && this.action.emit)
            this.$bus.emit(this.action.emit);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    replaceUrl(url) {
      url = this._.replace(url, "{{route.path}}", this.$route.path);
      url = this._.replace(url, "{{key}}", this.keyVauel);
      return url;
    }
  },
  computed: {
    handleUrl() {
      let handleUrl = null;
      if (this.action.handleUrl) {
        handleUrl = this.replaceUrl(this.action.handleUrl);
      }
      return handleUrl;
    },
    vueRoute() {
      let vueRoute = null;
      if (this.action.vueRoute) {
        vueRoute = this.replaceUrl(this.action.vueRoute);
      }
      return vueRoute;
    },
    row() {
      if (this.scope.row) return this.scope.row;
      if (this.scope.data) return this.scope.data;
      return this.scope.row;
    },
    keyVauel() {
      return this.row[this.key_name];
    }
  }
};
</script>