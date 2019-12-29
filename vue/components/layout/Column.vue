<template>
    <Col :span="span">
        <slot></slot>
    </Col>
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
