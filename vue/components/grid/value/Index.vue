<template>
  <span v-if="disPlayType=='default'">{{value}}</span>
  <Tag v-else-if="disPlayType=='tag'" :value="value" :attrs="attrs" />
  <Link v-else-if="disPlayType=='link'" :value="value" :attrs="attrs" />
</template>
<script>
import Tag from "./Tag";
import Link from "./Link";
export default {
  components: {
    Tag,
    Link
  },
  props: {
    value: {
      default: null
    },
    column_attr: Object
  },
  computed: {
    attrs() {
      return this.column_attr.displayComponentAttrs;
    },
    disPlayType() {
      try {
        return this.attrs.name;
      } catch (error) {
        return "default";
      }
    }
  }
};
</script>