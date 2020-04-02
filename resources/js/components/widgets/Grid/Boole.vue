<template>
  <span>
    <i class="el-icon-success status" v-if="value"></i>
    <i class="el-icon-error status" v-else></i>
  </span>
</template>
<script>
import { GridColumnComponent } from "@/mixins";
export default {
  mixins: [GridColumnComponent]
};
</script>
<style lang="scss" scoped>
.status {
  font-size: 20px;
}
.el-icon-success {
  color: #67c23a;
}
.el-icon-error {
  color: #f56c6c;
}
</style>
