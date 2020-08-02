<template>
  <el-link
    :style="attrs.style"
    :class="attrs.className"
    @click="goRoute"
    :underline="false"
    :icon="attrs.icon"
    :type="attrs.type"
    v-html="value"
  ></el-link>
</template>
<script>
var flatten = require('flat')
import { GridColumnComponent } from "@/mixins.js";
export default {
  mixins: [GridColumnComponent],
  methods: {
    goRoute() {
      this.$router.push(this.uri);
    },
  },
  computed: {
    uri() {
      //替换变量
      let uri = this.attrs.uri;

      let flattenRow = flatten(this.row)

      this._.forEach(flattenRow, (value, key) => {
        uri = this._.replace(uri, "{" + key + "}", value);
      });
      return uri;
    },
  },
};
</script>
