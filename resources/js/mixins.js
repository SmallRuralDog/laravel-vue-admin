const GridColumnComponent = {
    props: {
        attrs: Object,
        row: Object,
        column_value: {
            default: null
        },
        value: {
            default: null
        }
    }
}

const FormItemComponent = {
    props: {
        value: {
            default: null
        },
        form_items: Array,
        //当前表单数据
        form_data: Object,
        //当前组件属性
        attrs: Object
    },
    model: {
        prop: "value",
        event: "change"
    },
    methods: {
        onChange(value) {
            this.$emit("change", value);
        }
    }
}

export {
    GridColumnComponent,
    FormItemComponent
}