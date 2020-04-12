<template>
  <el-dropdown class="mr-10">
    <el-button :disabled="rows.length <= 0">
      <span>已选择 {{ rows.length }} 项</span>
      <i class="el-icon-arrow-down el-icon--right"></i>
    </el-button>
    <el-dropdown-menu slot="dropdown">
      <component
        v-for="(component, index) in actions"
        :key="component.componentName + index"
        :is="component.componentName"
        :action="component"
        :keys="keys"
      />
    </el-dropdown-menu>
  </el-dropdown>
</template>
<script>
export default {
  props: {
    rows: Array,
    routers: Object,
    key_name: String,
    actions: Array
  },
  methods: {},
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
