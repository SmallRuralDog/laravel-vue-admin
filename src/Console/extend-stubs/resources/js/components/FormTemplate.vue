<template>
    <div class="form-page">
        <el-card shadow="never" class="form-card">
            <el-form :model="formData" ref="ruleForm">
                <div class="form-bottom-actions">
                    <div></div>
                    <div>
                        <el-button
                            class="submit-btn"
                            type="primary"
                            @click="submitForm('ruleForm')"
                        >{{ isEdit ? "立即修改" : "立即创建" }}
                        </el-button>
                        <el-button class="submit-btn" @click="$router.go(-1)"
                        >返回
                        </el-button
                        >
                    </div>
                </div>
            </el-form>
        </el-card>
    </div>
</template>
<script>
    export default {
        props: {
            attrs: Object
        },
        data() {
            return {
                isEdit: false,
                formData: {}
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate(valid => {
                    if (valid) {
                    } else {
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    };
</script>
<style lang="scss"></style>
