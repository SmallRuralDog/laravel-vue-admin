<template>
  <div class="grid-actions">
    <template v-for="(action, index) in order_action_list">
      <span :key="action.componentName + index">
        <component
          :is="action.componentName"
          :scope="scope"
          :action="action"
          :key_name="key_name"
        />
      </span>
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
    order_action_list(){
      return window._.orderBy(this.action_list,['order'],['desc'])
    }
  }
};
</script>
<style lang="scss">
.grid-actions {
  .el-button + .el-button {
    margin-left: 0;
  }
  span + span {
    margin-left: 10px;
  }
}
</style>
