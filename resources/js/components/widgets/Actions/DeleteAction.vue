<template>
  <el-popconfirm
    placement="top"
    title="确定要删除此内容？"
    @onConfirm="onHandle"
  >
    <el-button
      slot="reference"
      type="text"
      :icon="action.icon"
      :loading="loading"
      class="action-button"
      >删除</el-button
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
