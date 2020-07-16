<template>
  <div class="form-page">
    <component
      v-if="attrs.top"
      :is="attrs.top.componentName"
      :attrs="attrs.top"
    />
    <component
      :is="attrs.attrs.isDialog ? 'div' : 'el-card'"
      shadow="never"
      class="form-card"
      v-loading="loading"
    >
      <el-form
        v-if="formData"
        :ref="attrs.ref || 'form'"
        :model="formData"
        :class="attrs.attrs.className"
        :style="attrs.attrs.style"
        :rules="attrs.formRules"
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
        <component :is="attrs.attrs.hideTab ? 'div' : 'el-tabs'">
          <component
            :is="attrs.attrs.hideTab ? 'div' : 'el-tab-pane'"
            :label="tab"
            v-for="tab in attrs.tabs"
            :key="tab"
          >
            <template v-for="(item, index) in attrs.formItems">
              <ItemIf
                v-if="tab == item.tab"
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
                  :prop="item.prop"
                  :label-width="item.labelWidth"
                  :error="item.error"
                  :show-message="item.showMessage"
                  :inline-message="item.inlineMessage"
                  :size="item.size"
                >
                  <span slot="label" v-if="!item.hideLabel">
                    {{ item.label }}
                  </span>
                  <template>
                    <el-col :span="item.inputWidth">
                      <template v-if="item.relationName">
                        <ItemDiaplsy
                          v-model="
                            formData[item.relationName][item.relationValueKey]
                          "
                          :form-item="item"
                          :form-items="attrs.formItems"
                          :form-data="formData"
                        />
                      </template>
                      <template v-else>
                        <ItemDiaplsy
                          v-model="formData[item.prop]"
                          :form-item="item"
                          :form-items="attrs.formItems"
                          :form-data="formData"
                        />
                      </template>

                      <div
                        v-if="item.help"
                        class="form-item-help"
                        v-html="item.help"
                      ></div>
                    </el-col>
                  </template>
                </el-form-item>
                <component
                  v-if="item.footerComponent"
                  :is="item.footerComponent.componentName"
                  :attrs="item.footerComponent"
                />
              </ItemIf>
            </template>
          </component>
        </component>
        <component
          :is="attrs.actions.fixed ? 'Affix' : 'div'"
          :offset-bottom="20"
        >
          <div
            class="form-bottom-actions flex padding-tb"
            :class="{ 'form-bottom-actions-fixedxxx': attrs.actions.fixed }"
          >
            <div>
              <component
                v-for="(component, index) in attrs.actions.addLeftActions"
                :key="component.componentName + index"
                :is="component.componentName"
                :attrs="component"
              />
            </div>
            <div class="flex">
              <component
                v-for="(component, index) in attrs.actions.addRightActions"
                :key="component.componentName + index"
                :is="component.componentName"
                :attrs="component"
              />
              <el-button
                v-if="attrs.actions.cancelButton"
                :style="attrs.actions.cancelButton.style"
                :class="attrs.actions.cancelButton.className"
                :type="attrs.actions.cancelButton.type"
                :size="attrs.actions.cancelButton.size"
                :plain="attrs.actions.cancelButton.plain"
                :round="attrs.actions.cancelButton.round"
                :circle="attrs.actions.cancelButton.circle"
                :disabled="attrs.actions.cancelButton.disabled"
                :icon="attrs.actions.cancelButton.icon"
                :autofocus="attrs.actions.cancelButton.autofocus"
                :loading="loading"
                @click="onCancel"
                ><template v-if="attrs.actions.cancelButton.content">{{
                  attrs.actions.cancelButton.content
                }}</template>
              </el-button>

              <el-button
                v-if="attrs.actions.submitButton"
                :style="attrs.actions.submitButton.style"
                :class="attrs.actions.submitButton.className"
                :type="attrs.actions.submitButton.type"
                :size="attrs.actions.submitButton.size"
                :plain="attrs.actions.submitButton.plain"
                :round="attrs.actions.submitButton.round"
                :circle="attrs.actions.submitButton.circle"
                :disabled="attrs.actions.submitButton.disabled"
                :icon="attrs.actions.submitButton.icon"
                :autofocus="attrs.actions.submitButton.autofocus"
                :loading="loading"
                @click="submitForm(attrs.ref || 'form')"
                ><template v-if="attrs.actions.submitButton.content">{{
                  attrs.actions.submitButton.content
                }}</template>
              </el-button>
            </div>
          </div>
        </component>
      </el-form>
    </component>
    <component
      v-if="attrs.bottom"
      :is="attrs.bottom.componentName"
      :attrs="attrs.bottom"
    />
  </div>
</template>
<script>
import { BaseComponent } from "@/mixins.js";
import ItemDiaplsy from "./ItemDiaplsy";
import ItemIf from "./ItemIf";
import { isNull } from "../../utils";
import Affix from "../widgets/common/affix";
export default {
  mixins: [BaseComponent],
  components: {
    ItemDiaplsy,
    ItemIf,
    Affix,
  },
  props: {
    attrs: Object,
  },
  computed: {
    isEdit() {
      return this.attrs.mode == "edit";
    },
    ignoreKey() {
      return this._.map(
        this.attrs.formItems.filter(
          (e) => !e.ignoreEmpty || !isNull(this.formData[e.prop])
        ),
        "prop"
      );
    },
  },
  data() {
    return {
      loading: false,
      init: false,
      formData: null,
    };
  },
  mounted() {
    this.formData = this._.cloneDeep(this.attrs.defaultValues);
    this.isEdit && this.getEditData();

    this.$bus.on("resetFormData", () => {
      this.formData = this._.cloneDeep(this.attrs.defaultValues);
    });
  },
  destroyed() {
    this.formData = this._.cloneDeep(this.attrs.defaultValues);
    //取消监听
    try {
      this.$bus.off("resetFormData");
    } catch (e) {}
  },
  methods: {
    getEditData() {
      this.loading = true;
      this.init = false;
      this.$http
        .get(this.attrs.dataUrl, {
          params: {
            get_data: true,
          },
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
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.loading = true;
          const formatData = this._.pick(this.formData, this.ignoreKey);
          if (this.isEdit) {
            this.$http
              .put(this.attrs.action, formatData)
              .then(({ data, code, message }) => {
                if (code == 200) {
                  if (this.attrs.attrs.isDialog) {
                    this.closeDialog();
                    this.$bus.emit("tableReload");
                  } else {
                    this.successRefData();
                  }
                }
              })
              .finally(() => {
                this.loading = false;
              });
          } else {
            this.$http
              .post(this.attrs.action, formatData)
              .then(({ data, code, message }) => {
                if (code == 200) {
                  if (this.attrs.attrs.isDialog) {
                    this.closeDialog();
                    this.$bus.emit("tableReload");
                  } else {
                    this.successRefData();
                  }
                }
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
    successRefData() {
      if (this.attrs.formRefData.successRefData) {
        this.$bus.emit(this.attrs.formRefData.successRefData.ref, {
          data: this.attrs.formRefData.successRefData.data,
          self: this,
        });
      } else {
        this.$router.go(-1);
      }
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    onCancel() {
      this.attrs.attrs.isDialog ? this.closeDialog() : this.$router.go(-1);
    },
    closeDialog() {
      this.$bus.emit("showDialogGridFrom", { isShow: false });
    },
  },
};
</script>
<style lang="scss">
.form-page {
  .form-card {
    min-height: 200px;
  }
  .form-bottom-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .admin-affix {
    .form-bottom-actions {
      padding: 6px;
      background: #ffffff;
      border-radius: 4px;
      border: 1px solid #ebeef5;
    }
  }

  .form-item-help {
    color: #999;
  }
}
</style>
