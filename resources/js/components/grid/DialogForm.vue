<template>
  <el-dialog
    title=""
    :width="dialogFormWidth+'px'"
    :visible.sync="dialogVisible"
    :close-on-click-modal="false"
    @closed="onClose"
  >
    <component
      v-if="showForm"
      :is="dialogForm.componentName"
      :attrs="selfDialogForm"
    />
  </el-dialog>
</template>
<script>
export default {
  props: {
    dialogForm: Object,
    dialogFormWidth: Number | null,
  },
  data() {
    return {
      dialogVisible: false,
      showForm: false,
      key: null,
      selfDialogForm: {},
    };
  },
  mounted() {
    this.selfDialogForm = this._.cloneDeep(this.dialogForm);
  },
  watch: {
    dialogVisible(val) {
      if (val) {
        if (this.key) {
          this.selfDialogForm.mode = "edit";
          this.selfDialogForm.dataUrl =
            this.dialogForm.dataUrl + "/" + this.key + "/edit";
          this.selfDialogForm.action = this.dialogForm.action + "/" + this.key;
        }

        this.showForm = true;
      }
    },
  },
  methods: {
    onClose() {
      this.showForm = false;
      this.key = null;
      this.selfDialogForm = this._.cloneDeep(this.dialogForm);
      this.$bus.emit("resetFormData");
    },
  },
};
</script>
