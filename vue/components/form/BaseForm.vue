<template>
  <div class="form-page">
    <el-card shadow="never">
      <el-form
        :rules="attrs.rules"
        :inline="attrs.inline"
        :label-position="attrs.labelPosition"
        :label-width="attrs.labelWidth"
        :label-suffix="attrs.labelSuffix"
        :hide-required-asterisk="attrs.hideRequiredAsterisk"
        :show-message="attrs.showMessage"
        :inline-message="attrs.inlineMessage"
        :status-icon="attrs.statusIcon"
        :validate-on-rule-change="attrs.validateOnRuleChange"
        :size="attrs.size"
        :disabled="attrs.disabled"
      >
        <template v-for="(item,index) in form_items">
          <el-form-item
            :key="index"
            :label="item.label"
            :prop="item.prop"
            :label-width="item.labelWidth"
            :required="item.required"
            :rules="item.rules"
            :error="item.error"
            :show-message="item.showMessage"
            :inline-message="item.inlineMessage"
            :size="item.size"
          >
            <ItemDiaplsy :attrs="item.component" />
            <div v-if='item.help' class="form-item-help" v-html="item.help"></div>
          </el-form-item>
        </template>

        <div class="form-bottom-actions">
          <el-button class="submit-btn" type="primary">提交</el-button>
          <el-button class="submit-btn" type="warning">清空</el-button>
        </div>
      </el-form>
    </el-card>
  </div>
</template>
<script>
import ItemDiaplsy from "./ItemDiaplsy";
export default {
  components: {
    ItemDiaplsy
  },
  props: {
    attrs: Object,
    form_items: Array
  }
};
</script>
<style lang="scss">
.form-page {
  .form-bottom-actions {
    text-align: center;
    .submit-btn {
      width: 180px;
    }
  }
  .form-item-help{
    color: #999;
  }
}
</style>