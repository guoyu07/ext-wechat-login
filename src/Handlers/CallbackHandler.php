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
use Notadd\WechatLogin\Models\WechatUser;
use Notadd\WechatLogin\Models\LoginStatus;

class CallbackHandler extends Handler
{
    protected $settings;

    public function execute()
    {
        $data = $this->request->input();

        $code = $data['code'];

        $socialite = app('wechat');

        $driver = $socialite->driver('wechat')->scopes(['snsapi_userinfo']);

        $accessToken = $driver->getAccessToken($code);

        $response = $driver->user($accessToken);

        $userInfo = $response->getOriginal();

        unset($userInfo['privilege']);

        $userInfo['user_id'] = 0;

        try {
            $result = WechatUser::updateOrCreate(['openid' => $userInfo['openid']], $userInfo);
        } catch (\Exception $exception) {
            dd($exception);
        }

        $token = $data['token'];

        $login = LoginStatus::where('token', $token)->update(['status' => 2, 'openid' => $userInfo['openid'], 'ip' => $this->request->getClientIp()]);
    }
}