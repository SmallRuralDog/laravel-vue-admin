<template>
  <div class="item-select">
    <el-card shadow="never">
      <div slot="header" class="flex align-center justify-between">
        <div>
          <el-input v-model="query" placeholder="">
            <el-button slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </div>
      </div>

      <el-scrollbar wrap-class="scrollbar-wrapper">
        <div style="height: 100vh;">13246578465</div>
      </el-scrollbar>
    </el-card>
  </div>
</template>
<script>
import { FormItemComponent } from "@/mixins";
export default {
  mixins: [FormItemComponent],
  data() {
    return {
      query: ""
    };
  }
};
</script>
<style lang="scss">
.item-select {
  .el-card {
    .el-card__header {
      padding: 10px;
    }

    .el-card__body {
      padding: 0;
    }
    .el-scrollbar {
      .scrollbar-wrapper {
        overflow-x: hidden;
        max-height: 300px;
      }
    }
  }
}
</style>
