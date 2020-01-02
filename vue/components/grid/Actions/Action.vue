<template>
  <a @click="onHandle" v-if="action.moreAction">
    <el-dropdown-item>{{action.name}}</el-dropdown-item>
  </a>
  <el-popconfirm
    v-else-if="action.type=='delete'"
    placement="top"
    title="确定要删除吗？"
    @onConfirm="onDelete"
  >
    <el-button
      slot="reference"
      type="text"
      size="mini"
      :icon="action.icon"
      :loading="delete_loading"
      class="action-button"
    >{{action.name}}</el-button>
  </el-popconfirm>
  <el-button
    v-else
    @click="onHandle"
    type="text"
    size="mini"
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
      delete_loading: false
    };
  },
  methods: {
    onHandle() {
      console.log(this.action, this.scope);
    },
    onDelete() {
      const deleteUrl = this.action.resource + "/" + this.keyVauel;
      this.delete_loading = true;
      this.$http
        .delete(deleteUrl)
        .then(({ code }) => {
          code === 200 && this.$bus.emit("tableReload");
        })
        .finally(() => {
          this.delete_loading = false;
        });
    }
  },
  computed: {
    row() {
      return this.scope.row;
    },
    keyVauel() {
      return this.row[this.key_name];
    }
  }
};
</script>