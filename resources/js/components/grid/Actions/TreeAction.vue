<template>
  <div class="grid-actions">
    <template v-for="action in action_list">
      <span :key="action.componentName">
        <component
          :is="action.componentName"
          :scope="{ row: scope.data, colum: {} }"
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
  computed: {}
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
