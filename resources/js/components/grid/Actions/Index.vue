<template>
  <div class="grid-actions">
    <template v-for="item in list">
      <span :key="item.type">
        <Action :scope="scope" :action="item" :key_name="key_name" />
      </span>
    </template>
    <template v-if="moreList.length>0">
      <span>
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
    data: Array,
    scope: Object
  },
  mounted() {

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
  span + span{
    margin-left: 10px;
  }
}
</style>