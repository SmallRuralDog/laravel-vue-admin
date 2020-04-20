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
    :remote-method="remoteMethod"
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
    <el-option v-if="attrs.paginate && loadMore && options.length" :value="undefined">
        <div @click.stop='paginateData($event)'>
          <i class="el-icon-loading"></i>
          <span>加载更多</span>
        </div>
    </el-option>
  </el-select>
</template>
<script>
export default {
  props: {
    attrs: Object,
    form_data: Object,
    value: {
      default: null
    }
  },
  data() {
    return {
      options: this.attrs.options,
      extUrlParams: this.attrs.extUrlParams,
      query: null,
      loadMore: true,
      meta: {
        page: 1,
        per_page: this.attrs.paginate
      }
    };
  },
  model: {
    prop: "value",
    event: "change"
  },
  computed: {
    depend() {
      return _.pick(this.form_data, this.attrs.depend);
    }
  },
  methods: {
    onChange(value) {
      let resValue = value
      if(typeof value === 'object'){
        // 排除value = 0
        resValue = value.filter(e=> e !== undefined)
      }else if(value === undefined){
        resValue = null
      }
      this.$emit("change", resValue);
    },
    remoteMethod(query) {
      this.query = query
      this.meta.page = 1
      this.$http
        .get(this.attrs.remoteUrl, { params: { ...this.meta, query: query, depend: this.depend, extUrlParams: this.extUrlParams } })
        .then(res => {
          this.options = res.data;
          this.meta.page++
          this.loadMore = true
        });
    },
    paginateData(event) {
      this.$http
        .get(this.attrs.remoteUrl, { params: { ...this.meta, query: this.query, depend: this.depend, extUrlParams: this.extUrlParams } })
        .then(res => {
          if (res.data.length) {
            this.options.push(...res.data)            
          }
          if(this.meta.page < res.meta.to){
            this.meta.page = res.meta.to
            this.loadMore = true
          }else{
            this.loadMore = false
          }
        })
    }
  }
};
</script>
