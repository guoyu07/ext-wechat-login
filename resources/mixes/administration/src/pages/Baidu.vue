<script>
    import injection from '../helpers/injection';

    export default {
        beforeRouteEnter(to, from, next) {
            injection.loading.start();
            injection.http.post(`${window.api}/baidu/get`).then(response => {
                const data = response.data.data;
                next(vm => {
                    vm.form.enabled = data.enabled === '1';
                    vm.form.token = data.token;
                    injection.loading.finish();
                    injection.sidebar.active('setting');
                });
            });
        },
        data() {
            return {
                form: {
                    enabled: true,
                    token: '',
                },
                loading: false,
                rules: {
                    token: [
                        {
                            required: true,
                            type: 'string',
                            message: injection.trans('baidu.setting.opinions.token.error'),
                            trigger: 'change',
                        },
                    ],
                },
                trans: injection.trans,
            };
        },
        methods: {
            submit() {
                const self = this;
                self.loading = true;
                self.$refs.form.validate(valid => {
                    if (valid) {
                        self.$http.post(`${window.api}/baidu/set`, self.form).then(() => {
                            self.$notice.open({
                                title: injection.trans('baidu.setting.success'),
                            });
                        }).finally(() => {
                            self.loading = false;
                        });
                    } else {
                        self.loading = false;
                        self.$notice.error({
                            title: injection.trans('baidu.setting.fail'),
                        });
                    }
                });
            },
        },
    };
</script>
<template>
    <card>
        <p slot="title">{{ trans('baidu.setting.title') }}</p>
        <i-form :label-width="200" :model="form" ref="form" :rules="rules">
            <row>
                <i-col span="14">
                    <form-item :label="trans('baidu.setting.opinions.open.label')">
                        <i-switch v-model="form.enabled" size="large">
                            <span slot="open">{{ trans('baidu.setting.opinions.open.open') }}</span>
                            <span slot="close">{{ trans('baidu.setting.opinions.open.close') }}</span>
                        </i-switch>
                    </form-item>
                </i-col>
            </row>
            <row>
                <i-col span="14">
                    <form-item :label="trans('baidu.setting.opinions.token.label')" prop="token">
                        <i-input :placeholder="trans('baidu.setting.opinions.token.placeholder')" v-model="form.token"></i-input>
                    </form-item>
                </i-col>
            </row>
            <row>
                <i-col span="14">
                    <form-item>
                        <i-button :loading="loading" type="primary" @click.native="submit">
                            <span v-if="!loading">{{ trans('baidu.setting.submit') }}</span>
                            <span v-else>{{ trans('baidu.setting.loading') }}</span>
                        </i-button>
                    </form-item>
                </i-col>
            </row>
        </i-form>
    </card>
</template>
