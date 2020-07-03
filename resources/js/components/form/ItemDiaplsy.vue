<template>
  <div>
    <component
      v-if="form_item.componentTopComponent"
      :is="form_item.componentTopComponent.componentName"
      :attrs="form_item.componentTopComponent"
    />
    <div class="flex align-center input-view">
      <component
        v-if="form_item.componentLeftComponent"
        :is="form_item.componentLeftComponent.componentName"
        :attrs="form_item.componentLeftComponent"
      />
      <component
        v-if="attrs"
        :value="value"
        :is="attrs.componentName"
        :attrs="attrs"
        :form_data="form_data"
        :form_items="form_items"
        @change="onChange"
      />
      <component
        v-if="form_item.componentRightComponent"
        :is="form_item.componentRightComponent.componentName"
        :attrs="form_item.componentRightComponent"
      />
    </div>
    <component
      v-if="form_item.componentBottomComponent"
      :is="form_item.componentBottomComponent.componentName"
      :attrs="form_item.componentBottomComponent"
    />
  </div>
</template>
<script>
import { BaseComponent } from "@/mixins.js";
import { getArrayValue } from "../../utils";
export default {
  mixins: [BaseComponent],
  props: {
    value: {
      default: null
    },
    form_items: Array,
    //fromItem数据
    form_item: Object,
    //当前表单数据
    form_data: Object
  },
  data() {
    return {};
  },
  model: {
    prop: "value",
    event: "change"
  },
  computed: {
    attrs() {
      return this.form_item.component;
    }
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>
<style lang="scss" scoped>
.el-form-item__content{
  .input-view {
    min-height: 40px;
  }
}
.el-form-item--medium {
  .input-view {
    min-height: 36px;
  }
}
.el-form-item--small {
  .input-view {
    min-height: 32px;
  }
}
.el-form-item--mini {
  .input-view {
    min-height: 28px;
  }
}
</style>