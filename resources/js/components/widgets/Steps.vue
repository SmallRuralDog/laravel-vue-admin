<template>
  <el-steps
    :style="attrs.style"
    :class="attrs.className"
    :space="attrs.space"
    :direction="attrs.direction"
    :process-status="attrs.processStatus"
    :finish-status="attrs.finishStatus"
    :align-center="attrs.alignCenter"
    :simple="attrs.simple"
    :active="attrs.active"
  >
    <el-step
      :title="step.title"
      :description="step.description"
      :icon="step.icon"
      :status="step.status"
      v-for="(step, index) in attrs.stepList"
      :key="index"
    ></el-step>
  </el-steps>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>
