<template>
  <el-select
    :value="value"
    :style="attrs.style"
    :class="attrs.className"
    :multiple="attrs.multiple"
    :disabled="attrs.disabled"
    :size="attrs.size"
    :clearable="attrs.clearable"
    :collapse-tags="attrs.collapseTags"
    :multiple-limit="attrs.multipleLimit"
    :name="attrs.name"
    :autocomplete="attrs.autocomplete"
    :placeholder="attrs.placeholder"
    :filterable="attrs.filterable"
    :allow-create="attrs.allowCreate"
    :remote="attrs.remote"
    :loading="attrs.loading"
    :loading-text="attrs.loadingText"
    :no-match-text="attrs.noMatchText"
    :no-data-text="attrs.noDataText"
    :popper-class="attrs.popperClass"
    :reserve-keyword="attrs.reserveKeyword"
    :default-first-option="attrs.defaultFirstOption"
    :popper-append-to-body="attrs.popperAppendToBody"
    :automatic-dropdown="attrs.automaticDropdown"
    @change="onChange"
  >
    <el-option
      v-for="(item, index) in options"
      :key="index"
      :label="item.label"
      :value="item.value"
      :disabled="item.disabled"
    >

      <div class="flex-c-sb">
        <div class="flex-c">
          <el-avatar
            v-if="item.avatar"
            :size="25"
            :src="item.avatar"
            class="mr-5"
          />
          <span>{{ item.label }}</span>
        </div>
        <div class="flex-c" v-if="item.desc" v-html="item.desc"></div>
      </div>
    </el-option>
  </el-select>
</template>
<script>
export default {
  props: {
    attrs: Object,
    form_data:Object,
    value: {
      default: null
    }
  },
  data() {
    return {
      options: this.attrs.options
    };
  },
  model: {
    prop: "value",
    event: "change"
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    }
  }
};
</script>
