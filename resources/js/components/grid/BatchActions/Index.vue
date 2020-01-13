<template>
  <el-dropdown class="mr-10">
    <el-button size="medium" :disabled="rows.length<=0">
      <span>已选择 {{rows.length}} 项</span>
      <i class="el-icon-arrow-down el-icon--right"></i>
    </el-button>
    <el-dropdown-menu slot="dropdown">
      <a @click="onBatchDelete">
        <el-dropdown-item>批量删除</el-dropdown-item>
      </a>
    </el-dropdown-menu>
  </el-dropdown>
</template>
<script>
export default {
  props: {
    rows: Array,
    routers: Object,
    key_name: String
  },
  methods: {
    onBatchDelete() {
      this.$confirm(
        "您确定删除这" + this.rows.length + "条数据吗？",
        "批量删除确认"
      )
        .then(() => {
          const deleteUrl = this.routers.resource + "/" + this.keys;
          this.$http
            .delete(deleteUrl)
            .then(({ code }) => {
              code === 200 && this.$bus.emit("tableReload");
            })
            .finally(() => {});
        })
        .catch(() => {});
    }
  },
  computed: {
    keys() {
      return this.rows
        .map(item => {
          return item[this.key_name];
        })
        .join(",");
    }
  }
};
</script>