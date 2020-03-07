<template>
    <el-button
        type="text"
        :icon="action.icon"
        :loading="loading"
        @click="onHandle"
    >编辑
    </el-button
    >
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
                console.log(this.key);
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
