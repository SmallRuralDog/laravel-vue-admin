<template>
  <div class="grid-container">
    <div class="grid-top-container">
      <div class="grid-top-container-left">
        <BatchActions
          :routers="routers"
          :key_name="key_name"
          :rows="selectionRows"
          v-if="selectionRows.length>0"
        />
        <a :href="routers.resource+'/create'">
          <el-button type="primary" size="medium" icon="el-icon-circle-plus-outline">新建</el-button>
        </a>
      </div>
      <div class="grid-top-container-right">
        <el-button
          :loading="loading"
          @click="getData"
          type="primary"
          size="medium"
          icon="el-icon-refresh"
        ></el-button>
      </div>
    </div>
    <el-card shadow="never" :body-style="{padding:0}">
      <div>
        <el-table
          v-loading="loading"
          :data="tableData"
          :default-sort="default_sort_get"
          :height="attributes.height"
          :max-height="attributes.maxHeight"
          :stripe="attributes.stripe"
          :border="attributes.border"
          :size="attributes.size"
          :fit="attributes.fit"
          :show-header="attributes.showHeader"
          :highlight-current-row="attributes.highlightCurrentRow"
          :empty-text="attributes.emptyText"
          :tooltip-effect="attributes.tooltipEffect"
          @sort-change="onTableSortChange"
          @selection-change="onTableselectionChange"
        >
          <template v-for="column in columns">
            <el-table-column
              v-if="column.type=='selection'"
              :type="column.type"
              :width="column.width"
              :align="column.align"
              :key="column.prop"
            ></el-table-column>
            <el-table-column
              v-else
              :type="column.type"
              :key="column.prop"
              :column-key="column.columnKey"
              :prop="column.prop"
              :label="column.label"
              :width="column.width"
              :sortable="column.sortable"
              :help="column.help"
              :align="column.align"
              :fixed="column.fixed"
              :header-align="column.headerAlign"
            >
              <template slot="header" slot-scope="scope">
                <span>{{scope.column.label}}</span>
                <el-tooltip
                  placement="top"
                  v-if="columns[scope.$index].help"
                  :content="columns[scope.$index].help"
                >
                  <i class="el-icon-question hover"></i>
                </el-tooltip>
              </template>
              <template slot-scope="scope">
                <ColumnDisplay :scope="scope" :columns="columns" />
              </template>
            </el-table-column>
          </template>
          <el-table-column v-if="!actions.hide">
            <template slot="header">操作</template>
            <template slot-scope="scope">
              <Actions :data="actions.data" :scope="scope" :key_name="key_name" />
            </template>
          </el-table-column>
        </el-table>
      </div>
      <div class="table-page" v-if="pageData.lastPage>1">
        <el-pagination
          layout="prev, pager, next, jumper,->,total, sizes"
          hide-on-single-page
          :total="pageData.total"
          :page-size="pageData.pageSize"
          :current-page="pageData.currentPage"
          :page-sizes="page_sizes"
          :background="page_background"
          @size-change="onPageSizeChange"
          @current-change="onPageCurrentChange"
        />
      </div>
    </el-card>
  </div>
</template>

<script>
import ColumnDisplay from "./ColumnDisplay";
import Actions from "./Actions/Index";
import BatchActions from "./BatchActions/Index";
export default {
  components: {
    ColumnDisplay,
    Actions,
    BatchActions
  },
  props: {
    key_name: String,
    default_sort: Object,
    column_attributes: Array,
    attributes: Object,
    data_url: String,
    page_sizes: Array,
    per_page: Number,
    page_background: Boolean,
    routers: Object,
    actions: Object
  },
  data() {
    return {
      loading: false,
      page: 1,
      sort: {},
      tableData: [],
      pageData: {
        pageSize: this.per_page,
        total: 0,
        currentPage: 1,
        lastPage: 1
      },
      selectionRows: []
    };
  },
  mounted() {
    this.getData();
    this.$bus.on("tableReload", () => {
      this.getData();
    });
  },
  methods: {
    //获取数据
    getData() {
      this.loading = true;
      this.$http
        .get(this.data_url, {
          params: {
            page: this.page,
            per_page: this.pageData.pageSize,
            ...this.sort
          }
        })
        .then(
          ({ data: { data, current_page, per_page, total, last_page } }) => {
            this.tableData = data;
            this.pageData.pageSize = per_page;
            this.pageData.currentPage = current_page;
            this.pageData.total = total;
            this.pageData.lastPage = last_page;
          }
        )
        .finally(() => {
          this.loading = false;
        });
    },
    //当表格的排序条件发生变化的时候会触发该事件
    onTableSortChange({ column, prop, order }) {
      if (order) {
        this.sort.sort_prop = column.columnKey;
        this.sort.sort_order = order == "ascending" ? "asc" : "desc";
      } else {
        this.sort = {};
      }
      this.getData();
    },
    //当选择项发生变化时会触发该事件
    onTableselectionChange(selection) {
      this.selectionRows = selection;
    },
    //每页大小改变时
    onPageSizeChange(per_page) {
      this.page = 1;
      this.pageData.pageSize = per_page;
      this.getData();
    },
    //页码改变时
    onPageCurrentChange(page) {
      this.page = page;
      this.getData();
    }
  },
  computed: {
    columns() {
      return this.column_attributes.map(attributes => {
        return attributes;
      });
    },
    default_sort_get() {
      return {
        prop: this.default_sort.prop,
        order: this.default_sort.order == "asc" ? "ascending" : "descending"
      };
    }
  }
};
</script>

<style lang="scss">
.grid-container {
  .table-page {
    padding: 16px 0;
  }
  .grid-top-container {
    padding: 16px 0px;
    display: flex;
    justify-content: space-between;
  }
}
</style>
