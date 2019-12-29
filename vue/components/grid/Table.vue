<template>
    <Card :bordered="false" dis-hover>
        <div>
            <Table :columns="columns" :data="tableData"></Table>
        </div>
        <div class="table-page">
            <Page :total="100"/>
        </div>
    </Card>
</template>

<script>
    export default {
        props: {
            column_config: Array
        },
        data() {
            return {
                tableData: []
            }
        },
        mounted() {

        },
        computed: {
            columns() {
                return this.column_config.map(config => {
                    /*config.renderHeader = (h, {column, index}) => {
                        return h('span', [
                            h('span', column.title),
                            h('Tooltip', {
                                props: {
                                    content: "123456",
                                    placement: "top"
                                },
                            }, [h('Icon', {props: {type: 'md-help-circle'},class:"hover ml-2"})]),
                        ])
                    };*/
                    config.sortable = true;
                    return config;
                });
            }
        }
    }
</script>

<style>
    .table-page {
        padding: 16px 0 0 0;
        text-align: center;
    }
</style>
