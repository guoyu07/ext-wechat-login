<script>
    import injection from '../helpers/injection';

    export default {
        beforeRouteEnter(to, from, next) {
            next(() => {
                injection.sidebar.active('setting');
            });
        },
        data() {
            const reg1 = /^(?=.*\d+)(?=.*[a-zA-Z]+)[\da-zA-Z]{18}$/;
            const reg2 = /^(?!^\d+$)(?!^[a-zA-Z]+$)[\da-zA-Z]{32}$/;
            const validatorWechatId = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('APP_ID不能为空'));
                } else if (!reg1.test(value)) {
                    callback(new Error('APP_ID必须为18位数字,字母组成的字符串(不含特殊字符)'));
                } else {
                    callback();
                }
            };
            const validatorAppSecret = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('APP_SECRET不能为空'));
                } else if (!reg2.test(value)) {
                    callback(new Error('APP_SECRET必须为32位数字,字母组成的字符串(不含特殊字符)'));
                } else {
                    callback();
                }
            };
            return {
                form: {
                    app_id: '',
                    app_secret: '',
                },
                loading: false,
                rules: {
                    app_id: [
                        {
                            required: true,
                            trigger: 'change',
                            validator: validatorWechatId,
                        },
                    ],
                    app_secret: [
                        {
                            required: true,
                            trigger: 'change',
                            validator: validatorAppSecret,
                        },
                    ],
                },
            };
        },
        methods: {
            submit() {
                const self = this;
                self.loading = true;
                self.$refs.form.validate(valid => {
                    if (valid) {
                        self.$http.post('https://allen.ibenchu.pw/api/wechat/set', self.form).then(() => {
                            self.$notice.open({
                                title: '微信公众平台设置配置项成功!',
                            });
                        }).finally(() => {
                            self.loading = false;
                        });
                    } else {
                        self.loading = false;
                        self.$notice.error({
                            title: '请正确填写设置信息',
                        });
                    }
                });
            },
        },
    };
</script>
<template>
    <div class="setting-wrap">
        <div class="wechat-login-wrap">
            <tabs value="name1">
                <tab-pane label="微信配置" name="name1">
                    <card :bordered="false">
                        <i-form :label-width="180" :model="form" ref="form" :rules="rules">
                            <row>
                                <i-col span="12">
                                    <form-item label="app_id" prop="app_id">
                                        <i-input v-model="form.app_id"></i-input>
                                    </form-item>
                                </i-col>
                            </row>
                            <row>
                                <i-col span="12">
                                    <form-item label="app_secret" prop="app_secret">
                                        <i-input v-model="form.app_secret"></i-input>
                                    </form-item>
                                </i-col>
                            </row>
                            <row>
                                <i-col span="12">
                                    <form-item>
                                        <i-button :loading="loading" type="primary" @click.native="submit">
                                            <span v-if="!loading">确认提交</span>
                                            <span v-else>正在提交…</span>
                                        </i-button>
                                    </form-item>
                                </i-col>
                            </row>
                        </i-form>
                    </card>
                </tab-pane>
            </tabs>
        </div>
    </div>
</template>
