<template>
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
      </component>
    </component>
    <div class="form-bottom-actions">
      <div></div>
      <div>
        <el-button
          :loading="loading"
          class="submit-btn"
          type="primary"
          @click="submitForm('ruleForm')"
          >提交</el-button
        >
      </div>
    </div>
  </el-form>
</template>
<script>
import ItemDiaplsy from "./ItemDiaplsy";
import ItemIf from "./ItemIf";
export default {
  components: {
    ItemDiaplsy,
    ItemIf,
  },
  props: {
    attrs: Object,
    keys: String,
  },
  data() {
    return {
      loading: false,
      isEdit: false,
      formData: {},
    };
  },
  mounted() {
    this.formData = this._.cloneDeep(this.attrs.formItemsValue);
  },
  computed: {
    actionUrl() {
      const keys = this.$store.getters.thisPage.grids.selectionKeys;

      return this._.replace(this.attrs.action, "selectionKeys", keys);
    },
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.loading = true;

          this.$http
            .post(this.actionUrl, this.formData)
            .then(({ data, code, message }) => {
              if (code == 200) {
                this.attrs.emits.map((item) => {
                  this.$bus.emit(item.name, item.data);
                });
              }
            })
            .finally(() => {
              this.loading = false;
            });
        } else {
          return false;
        }
      });
    },
    resetForm(formName) {},
  },
};
</script>
<style lang="scss" scoped>
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
</style>
