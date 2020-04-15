<template>
  <div class="form-page">
    <el-card shadow="never" class="form-card" v-loading="loading" title="创建">
      <el-form
        v-if="formData"
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
        <template v-for="(item, index) in attrs.formItems">
          <ItemIf
            :key="index"
            :form_item="item"
            :form_items="attrs.formItems"
            :form_data="formData"
          >
            <component
              v-if="item.topComponent"
              :is="item.topComponent.componentName"
              :attrs="item.topComponent"
            />

            <el-form-item
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
              <template>
                <el-row>
                  <el-col :span="item.inputWidth">
                    <template v-if="item.relationName">
                      <ItemDiaplsy
                        v-model="
                          formData[item.relationName][item.relationValueKey]
                        "
                        :form_item="item"
                        :form_items="attrs.formItems"
                        :form_data="formData"
                      />
                    </template>
                    <template v-else>
                      <ItemDiaplsy
                        v-model="formData[item.prop]"
                        :form_item="item"
                        :form_data="formData"
                      />
                    </template>

                    <div
                      v-if="item.help"
                      class="form-item-help"
                      v-html="item.help"
                    ></div>
                  </el-col>
                </el-row>
              </template>
            </el-form-item>
            <component
              v-if="item.footerComponent"
              :is="item.footerComponent.componentName"
              :attrs="item.footerComponent"
            />
          </ItemIf>
        </template>
        <div class="form-bottom-actions">
          <div></div>
          <div>
            <el-button
              :loading="loading"
              class="submit-btn"
              type="primary"
              @click="submitForm('ruleForm')"
              >{{ isEdit ? "立即修改" : "立即创建" }}</el-button
            >
            <el-button class="submit-btn" @click="$router.go(-1)"
              >返回</el-button
            >
          </div>
        </div>
      </el-form>
    </el-card>
  </div>
</template>
<script>
import ItemDiaplsy from "./ItemDiaplsy";
import ItemIf from "./ItemIf";
import { isNull } from "../../utils";
export default {
  components: {
    ItemDiaplsy,
    ItemIf
  },
  props: {
    attrs: Object
  },
  computed: {
    isEdit() {
      return this.attrs.mode == "edit";
    },
    ignoreKey() {
      return this._.map(this.attrs.formItems.filter(e => !e.ignoreEmpty || !isNull(this.formData[e.prop])) ,'prop')
    }
  },
  data() {
    return {
      loading: false,
      init: false,
      formData: null
    };
  },
  mounted() {
    this.formData = this._.cloneDeep(this.attrs.defaultValues);
    this.isEdit && this.getEditData();
  },
  destroyed(){
    this.formData = this._.cloneDeep(this.attrs.defaultValues);
  },
  methods: {
    getEditData() {
      this.loading = true;
      this.init = false;
      this.$http
        .get(this.attrs.dataUrl, {
          params: {
            get_data: true
          }
        })
        .then(({ data }) => {
          this.formData = data;
          this.init = true;

          //发送表单编辑数据加载完毕事件
          this.$nextTick(() => {
            this.$bus.emit("EditDataLoadingCompleted");
          });
        })
        .finally(() => {
          this.loading = false;
        });
    },
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          this.loading = true;
          console.log(this.ignoreKey)
          const formatData = this._.pick(this.formData, this.ignoreKey)
          if (this.isEdit) {
            this.$http
              .put(this.attrs.action, formatData)
              .then(({ data, code, message }) => {
                if (code == 200) {
                  
                  this.$router.go(-1);
                }
              })
              .finally(() => {
                this.loading = false;
              });
          } else {
            this.$http
              .post(this.attrs.action, formatData)
              .then(({ data, code, message }) => {
                code == 200 && this.$router.go(-1);
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
  .form-card {
    min-height: 200px;
  }
  .el-form-item__content {
    //line-height: unset;
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
