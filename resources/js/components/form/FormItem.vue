<template>
  <item-if :form-data="formData" :form-item="item">
    <component
      v-if="item.topComponent"
      :is="item.topComponent.componentName"
      :attrs="item.topComponent"
    />

    <el-form-item
      :prop="item.prop"
      :error="item.error"
      :show-message="item.showMessage"
      :inline-message="item.inlineMessage"
      :size="item.size"
      :label-width="item.labelWidth"
    >
      <span slot="label" v-if="!item.hideLabel">{{ item.label }}</span>
      <el-col :span="item.inputWidth">
        <ItemDisplay
          v-if="item.relationName"
          v-model="formData[item.relationName][item.relationValueKey]"
          :form-item="item"
          :form-data="formData"
          v-bind="$attrs"
        />
        <ItemDisplay
          v-else
          v-model="formData[item.prop]"
          :form-item="item"
          :form-data="formData"
          v-bind="$attrs"
        />
        <div v-if="item.help" class="form-item-help" v-html="item.help"></div>
      </el-col>
    </el-form-item>
    <component
      v-if="item.footerComponent"
      :is="item.footerComponent.componentName"
      :attrs="item.footerComponent"
    />
  </item-if>
</template>
<script>
import ItemDisplay from "./ItemDisplay";
import ItemIf from "./ItemIf";
export default {
  props: ["attrs", "formData"],
  components: {
    ItemDisplay,
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
