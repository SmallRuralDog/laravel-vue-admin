<template>
    <el-col :span="span">
        <slot></slot>
    </el-col>
</template>

<script>
    export default {
        props: {
            span: Number
        }
    }
</script>

<style>

</style>
