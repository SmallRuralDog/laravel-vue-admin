<template>
  <span class="tree-display-column">
    <template v-if="_.isArray(value)">
      <template v-for="(item, key) in value">
        <Value :value="item" :column_attr="columnAttr" :key="key" :row="row" :column_value="value" />
      </template>
    </template>
    <template v-else>
      <Value :value="value" :column_attr="columnAttr" :row="row" :column_value="value" />
    </template>
  </span>
</template>
<script>
import { getArrayValue } from "@/utils";
import Value from "./Column";
export default {
  props: {
    data: Object,
    column: Object,
    index: Number,
    columns: Array
  },
  components: {
    Value
  },
  data() {
    return {};
  },
  mounted() {

  },
  computed: {
    value() {
      return this._.get(this.row,this.columnKey,"");
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
      return this.data;
    },
    rowIndex() {
      return this.index;
    },
    columnKey() {
      return this.column.columnKey;
    },
    columnKeyPath() {
      return this._.split(this.columnKey, ".");
    }
  },
  filters: {}
};
</script>
<style lang="scss">
.tree-display-column {
  vertical-align: middle;
  display: inline-block;
  line-height: 1;
  .el-tag {
    margin-bottom: 2px;
    margin-top: 2px;
    margin-right: 4px;
  }
}
.tree-display-column + .tree-display-column{
  margin-left: 10px;
}
</style>
