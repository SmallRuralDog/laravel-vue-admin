<template>

</template>
<script>
    export default {
        props: {
            attrs: Object,
            form_data: Object,
            value: {
                default: null
            }
        },
        data() {
            return {
                options: this.attrs.options
            };
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
    };
</script>
