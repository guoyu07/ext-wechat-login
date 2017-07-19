<script>
    import injection from '../helpers/injection';

    export default {
        beforeRouteEnter(to, from, next) {
            next(() => {
                injection.sidebar.active('setting');
            });
        },
        data() {
            return {
                form: {
                    app_id: '',
                    app_secret: '',
                },
                loading: false,
            };
        },
        methods: {
            submit() {
                const self = this;
                self.loading = true;
                self.$refs.form.validate(valid => {
                    if (valid) {
                        self.$Message.success('提交成功!');
                    } else {
                        self.loading = false;
                        self.$notice.error({
                            title: '请正确填写设置信息！',
                        });
                    }
                });
            },
        },
    };
</script>
<template>
    <div class="setting-wrap">
        <div class="wechat-log-wrap">
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
