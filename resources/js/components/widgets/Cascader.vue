<template>
  <el-cascader-panel
    v-if="attrs.panel"
    :style="attrs.style"
    :class="attrs.className"
    v-model="vm"
    :size="attrs.size"
    :placeholder="attrs.placeholder"
    :disabled="attrs.disabled"
    :clearable="attrs.clearable"
    :show-all-levels="attrs.showAllLevels"
    :collapse-tags="attrs.collapseTags"
    :separator="attrs.separator"
    :filterable="attrs.filterable"
    :debounce="attrs.debounce"
    :popper-class="attrs.popperClass"
    :props="props"
    :options="options"
    @change="onChange"
  />
  <el-cascader
    v-else
    :style="attrs.style"
    :class="attrs.className"
    v-model="vm"
    :size="attrs.size"
    :placeholder="attrs.placeholder"
    :disabled="attrs.disabled"
    :clearable="attrs.clearable"
    :show-all-levels="attrs.showAllLevels"
    :collapse-tags="attrs.collapseTags"
    :separator="attrs.separator"
    :filterable="attrs.filterable"
    :debounce="attrs.debounce"
    :popper-class="attrs.popperClass"
    :props="props"
    :options="options"
    @change="onChange"
  />
</template>
<script>
export default {
  props: {
    attrs: Object,
    value: {
      default: null
    }
  },
  data() {
    return {
      vm: 0,
      props: {},
      options: []
    };
  },
  mounted() {
    this.props = this.attrs.props;
    if (this.props.lazyUrl) {
      this.props.lazyLoad = this.onLazyLoad;
    }
    this.options = this.attrs.options;
  },
  model: {
    prop: "value",
    event: "change"
  },
  methods: {
    onChange(value) {
      this.$emit("change", value);
    },
    onLazyLoad(node, resolve) {
      this.$http
        .post(this.props.lazyUrl, {
          params: {
            ...node.data
          }
        })
        .then(({ data }) => {
          console.log(data);
          resolve(data);
        });
    }
  }
};
</script>