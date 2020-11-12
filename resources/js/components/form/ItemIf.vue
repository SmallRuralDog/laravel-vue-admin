<template>
  <div v-if="ifVif && ivEval">
    <slot></slot>
  </div>
</template>
<script>
export default {
  props: {
    formItem: Object,
    formData: Object,
  },
  mounted() {},
  computed: {
    ifVif() {
      let key = this.formItem.vif.key;
      let value = this.formItem.vif.value;
      let anyValue = this.formItem.vif.anyValue;

      if (key) {
        let cValue = window._.get(this.formData, key);
        if (cValue == value || (cValue && anyValue)) {
          return true;
        } else {
          return false;
        }
      }

      return !anyValue;
    },
    ivEval() {
      try {
        if (!this.formItem.vifEval) {
          return true;
        }
        let expression = this.formItem.vifEval.expression;
        let props = this.formItem.vifEval.props;
        props.map((prop) => {
          window._.get(this.formData, prop);
        });
        if (expression) {
          return eval(expression);
        }
        return true;
      } catch (error) {
        console.error("表达式错误：" + error);
        return true;
      }
    },
  },
};
</script>
