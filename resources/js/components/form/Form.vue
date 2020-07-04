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
      title="创建"
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
                  <span slot="label" v-if="!item.hideLabel">{{
                    item.label
                  }}</span>
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
        <div class="form-bottom-actions">
          <div></div>
          <div>
            <el-button
              v-if="!attrs.attrs.isDialog"
              class="submit-btn"
              @click="$router.go(-1)"
              :style="{ width: attrs.attrs.buttonWidth }"
              >{{ attrs.attrs.backButtonName }}</el-button
            >
            <el-button
              v-else
              class="submit-btn"
              @click="closeDialog"
              :style="{ width: attrs.attrs.buttonWidth }"
              >{{ attrs.attrs.backButtonName }}</el-button
            >
            <el-button
              :loading="loading"
              class="submit-btn"
              type="primary"
              :style="{ width: attrs.attrs.buttonWidth }"
              @click="submitForm(attrs.ref || 'form')"
              >{{
                isEdit
                  ? attrs.attrs.updateButtonName
                  : attrs.attrs.createButtonName
              }}</el-button
            >
          </div>
        </div>
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
export default {
  mixins: [BaseComponent],
  components: {
    ItemDiaplsy,
    ItemIf,
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
                    this.$router.go(-1);
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
                    this.$router.go(-1);
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
    resetForm(formName) {
      this.$refs[formName].resetFields();
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
  .el-form-item__content {
    //line-height: unset;
  }
  .form-bottom-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .form-item-help {
    color: #999;
  }
}
</style>
