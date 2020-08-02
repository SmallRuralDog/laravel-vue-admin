const GridColumnComponent = {
    props: {
        attrs: Object,
        row: Object,
        columnValue: {
            default: null
        },
        value: {
            default: null
        }
    }
}

const FormItemComponent = {
    data() {
        return {
            vm: this._.cloneDeep(this.value)
        }
    },
    props: {
        value: {
            default: null
        },
        formItems: Array,
        formItem: Object,
        //当前表单数据
        formData: Object,
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
    },
    watch: {
        value(value) {
            try {
                this.vm = value;
            } catch (error) {

            }

        }
    }
}

const BaseComponent = {
    mounted() {

        if (this.attrs && this.attrs.ref) {
            this.$bus.on(this.attrs.ref, ({ data, self }) => {
                let _this = this;
                new Function('ref', 'self', data)(_this, self)
            })
        }

        if (this.formItem && this.formItem.ref) {
            this.$bus.on(this.formItem.ref, ({ data, self }) => {
                let _this = this;
                new Function('ref', 'self', data)(_this, self)
            })
        }
    },
    destroyed() {
        if (this.attrs && this.attrs.ref) {
            this.$bus.off(this.attrs.ref);
        }
        if (this.formItem && this.formItem.ref) {
            this.$bus.off(this.formItem.ref);
        }
    },
}

export {
    GridColumnComponent,
    FormItemComponent,
    BaseComponent
}