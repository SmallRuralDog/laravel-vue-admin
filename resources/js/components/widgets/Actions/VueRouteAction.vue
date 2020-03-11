<template>
  <el-button type="text" :icon="action.icon" @click="onHandle">{{
    action.name
  }}</el-button>
</template>
<script>
export default {
  props: {
    scope: Object,
    action: Object,
    key_name: String
  },
  methods: {
    onHandle() {
      if (this.action.httpPath) {
        window.location.href = this.http_path;
      } else {
        this.$router.push(this.path);
      }
    }
  },
  computed: {
    path() {
      let path = this.action.path;
      this._.forEach(this.row, (value, key) => {
        path = this._.replace(path, "{" + key + "}", value);
      });
      return path;
    },
    http_path() {
      let path = this.action.httpPath;
      this._.forEach(this.row, (value, key) => {
        path = this._.replace(path, "{" + key + "}", value);
      });
      return path;
    },
    colum() {
      return this.scope.colum;
    },
    row() {
      return this.scope.row;
    },
    key() {
      return this.scope.row[this.key_name];
    }
  }
};
</script>
