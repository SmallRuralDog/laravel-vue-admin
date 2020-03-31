<template>
  <span>
    <el-button
      :type="action.type"
      :size="action.size"
      :plain="action.plain"
      :round="action.round"
      :circle="action.circle"
      :disabled="action.disabled"
      :icon="action.icon"
      :autofocus="action.autofocus"
      :loading="loading"
      @click="onHandle"
      >{{ action.content }}</el-button
    >
  </span>
</template>
<script>
export default {
  props: {
    scope: Object,
    action: Object,
    key_name: String
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    onHandle() {
      this.$router.push(this.$route.path + "/" + this.key + "/edit");
    }
  },
  computed: {
    colum() {
      return this.scope.colum;
    },
    row() {
      return this.scope.row;
    },
    key() {
      return this.scope.row[this.key_name];
    }
  }
};
</script>
<style lang="scss" scoped></style>
