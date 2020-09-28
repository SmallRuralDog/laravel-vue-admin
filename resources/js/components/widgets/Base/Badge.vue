<template>
    <el-badge :style="attrs.style" :class="attrs.className" :value="attrs.value" :max="attrs.max" :is-dot="attrs.isDot"
              :hidden="attrs.hidden" :type="attrs.type">
        <component
            v-if="attrs.child"
            :is="attrs.child.componentName"
            :attrs="attrs.child"
            v-bind="$attrs"
        />
    </el-badge>
</template>

<script>
import {BaseComponent} from "@/mixins.js";

export default {
    mixins: [BaseComponent],
    props: {
        attrs: Object
    }
};
</script>
