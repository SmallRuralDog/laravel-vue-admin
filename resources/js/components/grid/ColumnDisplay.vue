<template>
  <div class="display-column">
    <template v-if="_.isArray(value)">
      <template v-for="(item, key) in value">
        <Value :value="item" :column-attr="columnAttr" :key="key" :row="row" :column-value="value" />
      </template>
    </template>
    <template v-else>
      <Value :value="value" :column-attr="columnAttr" :row="row" :column-value="value" />
    </template>
  </div>
</template>
<script>
import { getArrayValue } from "@/utils";
import Value from "./Column";
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
        console.warn("找不到column，请检查Column 的prop参数设置");
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
  vertical-align: middle;
  display: inline-block;
  line-height: 1;
  .el-tag {
    margin-bottom: 2px;
    margin-top: 2px;
    margin-right: 4px;
  }
  .el-image + .el-image {
    margin-left: 5px;
  }
}
</style>
