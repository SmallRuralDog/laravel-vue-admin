<template>
  <div class="grid-container">
    <el-card shadow="never" :body-style="{ padding: 0 }">
      <div class="grid-top-container">
        <div class="grid-top-container-left">
          <BatchActions
            :routers="attrs.routers"
            :key_name="attrs.keyName"
            :rows="selectionRows"
            v-if="attrs.selection"
          />
          <div class="search-view mr-10">
            <el-input
              v-model="quickSearch"
              :placeholder="attrs.quickSearch.placeholder"
              :clearable="true"
              @clear="getData"
              @keyup.enter.native="getData"
              v-if="attrs.quickSearch"
            >
              <el-button @click="getData" :loading="loading" slot="append"
                >搜索</el-button
              >
            </el-input>
          </div>
          <div>
            <component
              v-for="(component, index) in attrs.toolbars.left"
              :key="component.componentName + index"
              :is="component.componentName"
              :attrs="component"
            />
          </div>
        </div>
        <div class="grid-top-container-right">
          <component
            v-for="(component, index) in attrs.toolbars.right"
            :key="component.componentName + index"
            :is="component.componentName"
            :attrs="component"
          />
          <el-divider
            direction="vertical"
            v-if="!attrs.attributes.hideCreateButton"
          ></el-divider>
          <div class="icon-actions">
            <el-dropdown trigger="click">
              <el-tooltip
                class="item"
                effect="dark"
                content="密度"
                placement="top"
              >
                <i class="el-icon-rank hover"></i>
              </el-tooltip>
              <el-dropdown-menu slot="dropdown">
                <a @click="attrs.attributes.size = null">
                  <el-dropdown-item>正常</el-dropdown-item>
                </a>
                <a @click="attrs.attributes.size = 'medium'">
                  <el-dropdown-item>中等</el-dropdown-item>
                </a>
                <a @click="attrs.attributes.size = 'small'">
                  <el-dropdown-item>紧凑</el-dropdown-item>
                </a>
                <a @click="attrs.attributes.size = 'mini'">
                  <el-dropdown-item>迷你</el-dropdown-item>
                </a>
              </el-dropdown-menu>
            </el-dropdown>

            <el-tooltip
              class="item"
              effect="dark"
              content="刷新"
              placement="top"
            >
              <i class="el-icon-refresh hover" @click="getData"></i>
            </el-tooltip>
          </div>
        </div>
      </div>
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
              v-if="column.type == 'selection'"
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
                <span>{{ scope.column.label }}</span>
                <el-tooltip
                  placement="top"
                  v-if="attrs.columnAttributes[scope.$index].help"
                  :content="attrs.columnAttributes[scope.$index].help"
                >
                  <i class="el-icon-question hover"></i>
                </el-tooltip>
              </template>
              <template slot-scope="scope">
                <ColumnDisplay
                  :scope="scope"
                  :columns="attrs.columnAttributes"
                />
              </template>
            </el-table-column>
          </template>
          <el-table-column
            v-if="attrs.actions && !attrs.actions.hide"
            label="操作"
          >
            <template slot="header"></template>
            <template slot-scope="scope">
              <Actions
                :action_list="attrs.actions.data"
                :scope="scope"
                :key_name="attrs.keyName"
              />
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
      quickSearch: null,
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
  destroyed() {
    try {
      this.$bus.off("tableReload");
    } catch (e) {}
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
            ...this.sort,
            ...this.q_search
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
    },
    q_search() {
      const q_search = new Object();
      this.attrs.quickSearch &&
        (q_search[this.attrs.quickSearch.searchKey] = this.quickSearch);
      return q_search;
    }
  }
};
</script>

<style lang="scss">
.grid-container {
  .table-page {
    padding: 8px 0;
  }
  .grid-top-container {
    padding: 8px;
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #ebeef5;
    .grid-top-container-left {
      display: flex;
      align-items: center;
    }
    .grid-top-container-right {
      display: flex;
      align-items: center;
      .icon-actions {
        display: flex;
        align-items: center;
        margin-left: 5px;
        i {
          font-size: 20px;
          margin-right: 10px;
        }
      }
    }
  }
}
</style>
