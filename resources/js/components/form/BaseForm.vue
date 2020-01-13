<template>
  <div class="form-page">
    <el-card shadow="never">
      <el-form
        ref="ruleForm"
        :model="formData"
        :class="attrs.className"
        :style="attrs.style"
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
            <ItemDiaplsy v-model="formData[item.prop]"  :item="item" />
            <div v-if="item.help" class="form-item-help" v-html="item.help"></div>
          </el-form-item>
        </template>

        <div class="form-bottom-actions">
          <div></div>
          <div>
            <el-button
              :loading="loading"
              class="submit-btn"
              type="primary"
              @click="submitForm('ruleForm')"
            >{{isEdit?'立即修改':'立即创建'}}</el-button>
            <el-button class="submit-btn" @click="resetForm('ruleForm')">取消</el-button>
          </div>
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
    action: String,
    data_url: String,
    mode: String,
    attrs: Object,
    form_items: Array,
    default_values: Object
  },
  computed: {
    isEdit() {
      return this.mode == "edit";
    }
  },
  data() {
    return {
      loading: false,
      formData: {}
    };
  },
  mounted() {
    this.formData = this.default_values;
    this.isEdit && this.getEditData();
  },
  methods: {
    getEditData() {
      this.loading = true;
      this.$http
        .get(this.data_url)
        .then(({ data }) => {
          this.formData = data;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          this.loading = true;
          if (this.isEdit) {
            this.$http
              .put(this.action, this.formData)
              .then(({ data }) => {})
              .finally(() => {
                this.loading = false;
              });
          } else {
            this.$http
              .post(this.action, this.formData)
              .then(({ data }) => {})
              .finally(() => {
                this.loading = false;
              });
          }
        } else {
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  }
};
</script>
<style lang="scss">
.form-page {
  .el-form-item__content{
    line-height: unset;
  }
  .form-bottom-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    .submit-btn {
      width: 120px;
    }
  }
  .form-item-help {
    color: #999;
  }
}
</style>