<template>
  <el-card
    :style="attrs.style"
    :class="attrs.className"
    :body-style="attrs.bodyStyle"
    :shadow="attrs.shadow"
  >
    <div slot="header" class="clearfix">
      <component
        v-if="attrs.header"
        :is="attrs.header.componentName"
        :attrs="attrs.header"
      />
    </div>
    <component
      v-if="attrs.content"
      :is="attrs.content.componentName"
      :attrs="attrs.content"
    />
  </el-card>
</template>
<script>
export default {
  props: {
    attrs: Object
  }
};
</script>
