<template>
  <div class="display-column">
    <template v-if="_.isArray(value)">
      <template v-for="(item,key) in value">
        <Value :value="item" :column_attr="columnAttr" :key="key" />
      </template>
    </template>
    <template v-else>
      <Value :value="value" :column_attr="columnAttr" />
    </template>
  </div>
</template>
<script>
import { getArrayValue } from "../../utils";
import Value from "../widgets/Column";
export default {
  props: {
    scope: Object,
    columns: Array
  },
  components: {
    Value
  },
  data() {
    return {};
  },
  mounted() {
    //console.log(this.columnKey);
  },
  computed: {
    value() {
      if (this.columnKeyPath.length == 1) return this.row[this.columnKey];
      try {
        let data = this.row[this.columnKeyPath[0]];
        let allData = getArrayValue(data, this.columnKeyPath, 0);
        allData = this._.flattenDeep(allData);
        return allData;
      } catch (error) {
        console.error("获取数组数据失败:" + error);
        return "-";
      }
    },
    columnAttr() {
      try {
        return this.columns.filter(item => {
          return item.prop == this.columnKey;
        })[0];
      } catch (e) {
        console.error("找不到column，请检查Column 的prop参数设置");
      }
    },
    row() {
      return this.scope.row;
    },
    rowIndex() {
      return this.scope.$index;
    },
    columnKey() {
      return this.scope.column.property;
    },
    columnKeyPath() {
      return this._.split(this.columnKey, ".");
    }
  },
  filters: {}
};
</script>
<style lang="scss">
.display-column {
  line-height: unset;
  .el-tag{
    margin-bottom: 2px;
    margin-top: 2px;
    margin-right: 4px;
  }
}
</style>