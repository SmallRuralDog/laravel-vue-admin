<template>
  <div class="grid-actions">
    <template v-for="(action, index) in order_action_list">
        <component
          :is="action.componentName"
          :key="action.componentName + index"
          :scope="scope"
          :action="action"
          :key_name="key_name"
        />
    </template>
  </div>
</template>
<script>
import Action from "./Action";
export default {
  components: {
    Action
  },
  props: {
    key_name: String,
    action_list: Array,
    scope: Object
  },
  mounted() {},
  computed: {
    order_action_list() {
      return window._.orderBy(this.action_list, ["order"], ["desc"]);
    },
    //当前表格/树形表格的字段定义
    colum() {
      return this.scope.colum;
    },
    //当前行的值
    row() {
      return this.scope.row;
    },
    //主键值
    key() {
      return this.scope.row[this.key_name];
    }
  }
};
</script>
<style lang="scss">
.grid-actions {
  white-space: nowrap;
  .el-button + .el-button {
    margin-left: 0;
  }
  span + span {
    margin-left: 10px;
  }
}
</style>
