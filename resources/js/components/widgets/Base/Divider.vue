<template>
  <el-divider
    :direction="attrs.direction"
    :content-position="attrs.contentPosition"
    >{{ attrs.content }}</el-divider
  >
</template>
<script>
export default {
  props: ["attrs"]
};
</script>
