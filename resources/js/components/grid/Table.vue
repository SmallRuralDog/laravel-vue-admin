<template>
  <div class="grid-container">
    <div class="grid-top-container">
      <div class="grid-top-container-left">
        <BatchActions
          :routers="attrs.routers"
          :key_name="attrs.keyName"
          :rows="selectionRows"
          v-if="attrs.selection"
        />
        <div class="search-view">
          <el-input v-model="search" size="medium" placeholder>
            <el-button slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </div>
      </div>
      <div class="grid-top-container-right">
        <router-link :to="path+'/create'">
          <el-button type="primary" size="medium" icon="el-icon-circle-plus-outline">新建</el-button>
        </router-link>
        <el-button :loading="loading" @click="getData" size="medium" icon="el-icon-refresh"></el-button>
      </div>
    </div>
    <el-card shadow="never" :body-style="{padding:0}">
      <div>
        <el-table
          v-loading="loading"
          :data="tableData"
          :row-key="attrs.attributes.rowKey"
          :default-sort="attrs.default_sort_get"
          :height="attrs.attributes.height"
          :max-height="attrs.attributes.maxHeight"
          :stripe="attrs.attributes.stripe"
          :border="attrs.attributes.border"
          :size="attrs.attributes.size"
          :fit="attrs.attributes.fit"
          :show-header="attrs.attributes.showHeader"
          :highlight-current-row="attrs.attributes.highlightCurrentRow"
          :empty-text="attrs.attributes.emptyText"
          :tooltip-effect="attrs.attributes.tooltipEffect"
          :default-expand-all="true"
          @sort-change="onTableSortChange"
          @selection-change="onTableselectionChange"
        >
          <template v-for="column in attrs.columnAttributes">
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
                  v-if="attrs.columnAttributes[scope.$index].help"
                  :content="attrs.columnAttributes[scope.$index].help"
                >
                  <i class="el-icon-question hover"></i>
                </el-tooltip>
              </template>
              <template slot-scope="scope">
                <ColumnDisplay :scope="scope" :columns="attrs.columnAttributes" />
              </template>
            </el-table-column>
          </template>
          <el-table-column v-if="!attrs.actions.hide">
            <template slot="header">操作</template>
            <template slot-scope="scope">
              <Actions :data="attrs.actions.data" :scope="scope" :key_name="attrs.keyName" />
            </template>
          </el-table-column>
        </el-table>
      </div>
      <div class="table-page">
        <el-pagination
          layout="prev, pager, next, jumper,->,total, sizes"
          :hide-on-single-page="false"
          :total="pageData.total"
          :page-size="pageData.pageSize"
          :current-page="pageData.currentPage"
          :page-sizes="attrs.pageSizes"
          :background="attrs.pageBackground"
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
    attrs: Object
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
      selectionRows: [],
      search: "",
      path: "/"
    };
  },
  mounted() {
    this.getData();
    this.$bus.on("tableReload", () => {
      this.getData();
    });

    this.path = this.$route.path;
  },
  methods: {
    //获取数据
    getData() {
      this.loading = true;
      this.$http
        .get(this.attrs.dataUrl, {
          params: {
            get_data: true,
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
    .grid-top-container-left {
      display: flex;
      align-items: center;
      .search-view {
      }
    }
  }
}
</style>
