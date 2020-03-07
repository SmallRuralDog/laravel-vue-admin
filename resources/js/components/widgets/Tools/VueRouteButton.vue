<template>
  <router-link :to="attr.vueRoute ? attr.vueRoute : '/'">
    <el-button
      :type="attr.type"
      :size="attr.size"
      :plain="attr.plain"
      :round="attr.round"
      :circle="attr.circle"
      :disabled="attr.disabled"
      :icon="attr.icon"
      :autofocus="attr.autofocus"
      class="mr-10"
      >{{ attr.content }}</el-button
    >
  </router-link>
</template>
<script>
export default {
  props: {
    attr: Object
  }
};
</script>
