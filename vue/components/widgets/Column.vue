<template>
  <span v-if="disPlayType=='default'">{{value}}</span>
  <component v-else :is='disPlayType' :value="value" :attrs="attrs"/>
</template>
<script>
import Tag from "./Tag";
import Link from "./Link";
import Avatar from "./Avatar";
export default {
  components: {
    Tag,
    Link,
    Avatar
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