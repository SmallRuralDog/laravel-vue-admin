<template>
  <div class="form-page">
    <el-card shadow="never">
      <el-form
        ref="ruleForm"
        :model="formData"
        :class="attrs.attrs.className"
        :style="attrs.attrs.style"
        :rules="attrs.attrs.rules"
        :inline="attrs.attrs.inline"
        :label-position="attrs.attrs.labelPosition"
        :label-width="attrs.attrs.labelWidth"
        :label-suffix="attrs.attrs.labelSuffix"
        :hide-required-asterisk="attrs.attrs.hideRequiredAsterisk"
        :show-message="attrs.attrs.showMessage"
        :inline-message="attrs.attrs.inlineMessage"
        :status-icon="attrs.attrs.statusIcon"
        :validate-on-rule-change="attrs.attrs.validateOnRuleChange"
        :size="attrs.attrs.size"
        :disabled="attrs.attrs.disabled"
      >
        <template v-for="(item,index) in attrs.formItems">
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
            <ItemDiaplsy v-model="formData[item.prop]" :item="item" />
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
            <el-button class="submit-btn" @click="$router.go(-1)">返回</el-button>
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
    attrs: Object
  },
  computed: {
    isEdit() {
      return this.attrs.mode == "edit";
    }
  },
  data() {
    return {
      loading: false,
      formData: {}
    };
  },
  mounted() {
    this.formData = this.attrs.defaultValues;
    this.isEdit && this.getEditData();
  },
  methods: {
    getEditData() {
      this.loading = true;
      this.$http
        .get(this.attrs.dataUrl, {
          params: {
            get_data: true
          }
        })
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
              .put(this.attrs.action, this.formData)
              .then(({ data }) => {
                data.code == 200 && this.$router.go(-1);
              })
              .finally(() => {
                this.loading = false;
              });
          } else {
            this.$http
              .post(this.attrs.action, this.formData)
              .then(({ data }) => {
                data.code == 200 && this.$router.go(-1);
              })
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
  .el-form-item__content {
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