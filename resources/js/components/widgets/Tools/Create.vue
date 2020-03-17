<template>
  <router-link :to="$route.path + '/create'">
    <el-button
      :type="attrs.type"
      :size="attrs.size"
      :plain="attrs.plain"
      :round="attrs.round"
      :circle="attrs.circle"
      :disabled="attrs.disabled"
      :icon="attrs.icon"
      :autofocus="attrs.autofocus"
      class="mr-10"
      >{{attrs.content}}</el-button
    >
  </router-link>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>
