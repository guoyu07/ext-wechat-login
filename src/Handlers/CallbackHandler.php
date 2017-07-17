<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-14 上午11:53
 */

namespace Notadd\WechatLogin\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Overtrue\Socialite\SocialiteManager;
use Illuminate\Support\Facades\Log;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

class CallbackHandler extends Handler
{
    protected $settings;

    public function execute()
    {
        $data = $this->request->input();

//        if (is_null($data) || ! in_array('code', $data) || ! in_array('state', $data)) {
//            $this->withCode(402)->withMessage('服务器异常，请稍候重试');
//        }

        $this->settings = $this->container->make(SettingsRepository::class);

        $code = $data['code'];

        $config = [
            'wechat' => [
                'client_id'     => $this->settings->get('wechatLogin.app_id', false),
                'client_secret' => $this->settings->get('wechatLogin.app_secret', false),
                'redirect'      => 'https://allen.ibenchu.pw/'
            ]
        ];

        $login = new SocialiteManager($config);

        $driver = $login->driver('wechat')->scopes(['snsapi_userinfo']);

        $token = $driver->getAccessToken($code);

        $response = $driver->user($token);

        Log::info($response->getOriginal());
    }
}