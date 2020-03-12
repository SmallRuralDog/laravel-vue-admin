<template>
  <el-button
    :type="attrs.type"
    :size="attrs.size"
    :plain="attrs.plain"
    :round="attrs.round"
    :circle="attrs.circle"
    :disabled="attrs.disabled"
    :icon="attrs.icon"
    :autofocus="attrs.autofocus"
    :loading="loading"
    class="mr-10"
    @click="onClick"
    >{{ attrs.content }}</el-button
  >
</template>
<script>
export default {
  props: {
    attrs: Object
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    onClick() {
      switch (this.attrs.handler) {
        case "route":
          this.$route.push(this.attrs.uri);
          break;
        case "link":
          window.location.href = this.attrs.uri;
          break;
        case "request":
          this.onRequest(this.attrs.uri);
          break;
        default:
          this.$Message.warning("响应类型未定义");
          break;
      }
    },
    onRequest(uri) {
      this.loading = true;
      this.$http
        .get(uri)
        .then(res => {
          if (res.code == 200) {
  
          }
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>
