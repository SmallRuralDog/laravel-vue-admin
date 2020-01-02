<template>
  <div class="grid-actions">
    <template v-for="item in list">
      <Action :key="item.type" :scope="scope" :action="item" :key_name="key_name" />
    </template>
    <template v-if="moreList.length>0">
      <el-dropdown>
        <el-button type="text" size="mini" icon="el-icon-more"></el-button>
        <el-dropdown-menu slot="dropdown">
          <Action
            :key="item.type"
            v-for="item in moreList"
            :scope="scope"
            :action="item"
            :key_name="key_name"
          />
        </el-dropdown-menu>
      </el-dropdown>
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
    data: Array,
    scope: Object
  },
  mounted() {
    //console.log(this.data);
  },
  computed: {
    list() {
      return this.data.filter(item => {
        return item.moreAction == false;
      });
    },
    moreList() {
      return this.data.filter(item => {
        return item.moreAction == true;
      });
    }
  }
};
</script>
<style lang="scss">
.grid-actions {
  .el-button + .el-button {
    margin-left: 0;
  }
  .action-button {
    padding: 0 5px;
  }
}
</style>