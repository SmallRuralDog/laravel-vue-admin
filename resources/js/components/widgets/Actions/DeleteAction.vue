<template>
  <el-popconfirm
    placement="top"
    :title="action.message"
    @onConfirm="onHandle"
  >
    <el-button
      slot="reference"
      :type="action.type"
      :size="action.size"
      :plain="action.plain"
      :round="action.round"
      :circle="action.circle"
      :disabled="action.disabled"
      :icon="action.icon"
      :autofocus="action.autofocus"
      :loading="loading"
      class="action-button"
      >{{action.content}}</el-button
    >
  </el-popconfirm>
</template>
<script>
export default {
  props: {
    scope: Object,
    action: Object,
    key_name: String
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    onHandle() {
      this.loading = true;
      this.$http
        .delete(this.action.resource + "/" + this.key)
        .then(({ code }) => {
          if (code === 200) this.$bus.emit("tableReload");
        })
        .finally(() => {
          this.loading = false;
        });
    }
  },
  computed: {
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
<style lang="scss" scoped></style>
