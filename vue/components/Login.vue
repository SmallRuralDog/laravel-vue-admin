<template>
    <div class="page-account"
         :style="{'background-image': 'url('+page_data.backgroundImage+')'}">
        <div class="page-account-container">
            <div class="page-account-top">
                <div class="page-account-top-logo"><img
                    :src="page_data.logo" alt="logo"></div>
                <div class="page-account-top-desc">{{page_data.desc}}</div>
            </div>
            <div class="login-form">
                <Form ref="formValidate" :model="form" :rules="ruleValidate">
                    <FormItem prop="username">
                        <Input autofocus v-model="form.username" prefix="ios-contact-outline" size="large"
                               placeholder="请输入用户名"/>
                    </FormItem>
                    <FormItem prop="password">
                        <Input v-model="form.password" type="password" prefix="ios-lock-outline" size="large" password
                               placeholder="请输入密码"/>
                    </FormItem>
                    <div class="page-account-auto-login">
                        <Checkbox v-model="form.remember" size="large">自动登录</Checkbox>
                        <a @click="onForgetPassword">忘记密码</a>
                    </div>
                    <FormItem>
                        <Button :loading="loading" @click="handleSubmit('formValidate')" type="primary" size="large"
                                long>登陆
                        </Button>
                    </FormItem>
                </Form>
            </div>
        </div>
        <footer class="global-footer i-copyright">
            <div class="global-footer-copyright">{{page_data.copyright}}</div>
        </footer>
    </div>
</template>
<script>
    export default {
        props: {
            page_data: Object
        },
        data() {
            return {
                form: {
                    username: 'admin',
                    password: 'admin',
                    remember: true,
                },
                loading: false,
                ruleValidate: {
                    username: [
                        {required: true, message: '请输入用户名', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'}
                    ],
                }
            }
        },
        mounted() {
            this.$Loading.start();
            this.$nextTick(() => {
                this.$Loading.finish();
            })
        },
        methods: {
            onForgetPassword() {
                this.$Message.info("忘记密码请联系管理员");
            },
            handleSubmit(name) {
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        this.$Loading.start();
                        this.$http.post(this.page_data.url.postLogin, this.form).then(() => {
                        }).catch(() => {
                            this.$Loading.error();
                        }).finally(() => {
                            this.loading = false;
                            this.$Loading.finish();
                        })
                    }
                })
            }
        }
    }
</script>
<style lang="scss" scoped>
    @media (min-width: 768px) {
        .page-account {
            //background-image: url(../img/body.8aa7c4a6.svg);
            background-repeat: no-repeat;
            background-position: 50%;
            background-size: 100%;
        }
        .page-account-container {
            padding: 32px 0 24px 0;
        }
    }

    .page-account-container {
        flex: 1;
        padding: 32px 0;
        width: 384px;
        margin: 0 auto;

        .page-account-top {
            padding: 32px 0;
            text-align: center;
        }

        .page-account-top-logo img {
            height: 75px;
        }

        .page-account-top-desc {
            font-size: 14px;
            color: #808695;
        }

        .page-account-auto-login {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

    }

    .global-footer {
        margin: 48px 0 24px 0;
        padding: 0 16px;
        text-align: center;
    }
</style>
