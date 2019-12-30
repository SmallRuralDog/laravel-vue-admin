<template>
  <el-card shadow="never">
    <div>
      <el-table
        :data="tableData"
        :stripe="attributes.stripe"
        :border="attributes.border"
        :size="attributes.size"
        :fit="attributes.fit"
        :show-header="attributes.showHeader"
        :highlight-current-row="attributes.highlightCurrentRow"
      >
        <el-table-column
          v-for="column in columns"
          :key="column.prop"
          :prop="column.prop"
          :label="column.label"
          :width="column.width"
          :sortable="column.sortable"
          :help="column.help"
        >
          <template slot="header" slot-scope="scope">
            <span>{{scope.column.label}}</span>
            <el-tooltip
              v-if="columns[scope.$index].help"
              :content="columns[scope.$index].help"
            >
              <i class="el-icon-question hover"></i>
            </el-tooltip>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="table-page">
      <el-pagination :total="100" />
    </div>
  </el-card>
</template>

<script>
export default {
  props: {
    column_attributes: Array,
    attributes: Object
  },
  data() {
    return {
      tableData: []
    };
  },
  mounted() {},
  computed: {
    columns() {
      return this.column_attributes.map(attributes => {
        return attributes;
      });
    }
  }
};
</script>

<style>
.table-page {
  padding: 16px 0 0 0;
  text-align: center;
}
</style>
