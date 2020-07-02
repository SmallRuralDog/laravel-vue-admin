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

const BaseComponent = {
    mounted() {

        if (this.attrs && this.attrs.ref) {
            this.$bus.on(this.attrs.ref, ({data,self}) => {
                let _this = this;
                new Function('ref','self',data)(_this,self)
            })
        }
    },
    destroyed() {
        if (this.attrs && this.attrs.ref) {
            this.$bus.off(this.attrs.ref);
        }
    },
}

export {
    GridColumnComponent,
    FormItemComponent,
    BaseComponent
}