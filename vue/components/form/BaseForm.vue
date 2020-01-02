<template>
  <div class="form-page">
    <el-card shadow="never">
      <el-form size="medium">
        <el-form-item label="123"></el-form-item>
        <div class="form-bottom-actions">
          <el-button class="submit-btn" type="primary">提交</el-button>
          <el-button class="submit-btn" type="warning">清空</el-button>
        </div>
      </el-form>
    </el-card>
  </div>
</template>
<script>
export default {};
</script>
<style lang="scss">
.form-page {
  .form-bottom-actions {
    text-align: center;
    .submit-btn{
      width: 180px;
    }
  }
}
</style>