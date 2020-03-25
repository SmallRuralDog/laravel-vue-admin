<template>
  <div class="grid-container">
    <el-card shadow="never" :body-style="{ padding: 0 }">
      <div class="grid-top-container">
        <div class="grid-top-container-left">
          <div class="search-view mr-10" v-if="attrs.quickSearch">
            <el-input
              v-model="quickSearch"
              size="medium"
              :placeholder="attrs.quickSearch.placeholder"
              :clearable="true"
              @clear="getData"
              
              @focus="onQuickSearchFocus"
              @blur="onQuickSearchBlur"
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
    </el-card>

    <el-card class="mt-10" shadow="never" :body-style="{ padding: 0 }">
      <div style="padding:10px;">
        <el-tree
          :data="tableData"
          :draggable="attrs.attributes.draggable"
          default-expand-all
          v-loading="loading"
          :empty-text="attrs.attributes.emptyText"
          :indent="10"
          @node-drop="onNodeDrop"
        >
          <div class="custom-tree-node" slot-scope="{ data, node }">
            <div class="custom-tree-node-item">
              <template v-for="(column, index) in attrs.columnAttributes">
                <TreeColumnDisplay
                  :key="index"
                  :data="data"
                  :index="index"
                  :column="column"
                  :columns="attrs.columnAttributes"
                />
              </template>
            </div>
            <div class="flex-c">
              <Actions
                :action_list="attrs.actions.data"
                :scope="node"
                :key_name="attrs.keyName"
              />
            </div>
          </div>
        </el-tree>
      </div>
    </el-card>
  </div>
</template>
<script>
import TreeColumnDisplay from "./TreeColumnDisplay";
import Actions from "./Actions/TreeAction";
export default {
  components: {
    TreeColumnDisplay,
    Actions
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
      window.removeEventListener("keydown", this.onEnt);
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
    onNodeDrop(node, before, after, inner) {
      this.$http
        .post(this.attrs.attributes.draggableUrl, {
          self: node.data,
          target: before.data,
          type: after
        })
        .then(() => {
          this.$Message.success("排序成功");
        });

      console.log(node);
      console.log(before);
      console.log(after);
      console.log(inner);
    }
  }
};
</script>
<style lang="scss">
.grid-container {
  .custom-tree-node {
    flex: 1;
    padding-right: 5px;
    display: flex;
    justify-content: space-between;
  }
  .custom-tree-node-item {
    flex: 1;
    display: flex;
    align-items: center;

    font-size: 14px;
    padding-right: 8px;
  }
  .el-tree-node__content {
    height: auto;
    margin: 1px 0;
  }
  .custom-tree-node {
    //border: 1px solid #dcdcdc;
    //padding: 2px 10px;
  }
}
</style>
