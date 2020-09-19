<template>
  <ItemIf v-if="tab == item.tab" :form_item="item" :form_items="formItems" :form_data="formData">
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
      <span slot="label" v-if="!item.hideLabel">{{ item.label }}</span>
      <template>
        <el-col :span="item.inputWidth">
          <template v-if="item.relationName">
            <ItemDiaplsy
              v-model="
                            formData[item.relationName][item.relationValueKey]
                          "
              :form-item="item"
              :form-items="formItems"
              :form-data="formData"
              v-bind="$attrs"
            />
          </template>
          <template v-else>
            <ItemDiaplsy
              v-model="formData[item.prop]"
              :form-item="item"
              :form-items="formItems"
              :form-data="formData"
              v-bind="$attrs"
            />
          </template>

          <div v-if="item.help" class="form-item-help" v-html="item.help"></div>
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
<script>
import ItemDiaplsy from "./ItemDiaplsy";
import ItemIf from "./ItemIf";
export default {
  props: ["attrs", "tab", "formData", "formItems"],
  components: {
    ItemDiaplsy,
    ItemIf,
  },
  mounted() {},
  computed: {
    item() {
      return this.attrs;
    },
  },
};
</script>