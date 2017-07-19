<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-19 下午5:20
 */

namespace Notadd\WechatLogin\Handlers;

use Illuminate\Support\Facades\Log;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\WechatLogin\Models\WechatUser;

class BindCallbackHandler extends Handler
{
    public function execute()
    {
        /**
         * verify the token's validity(5 min = 300s)
         */

        $token = $this->request->input('token');

        $timestamp = substr($token, 22);

        if (time() - $timestamp > 300) {
            $this->withCode(402)->withMessage('token失效，请刷新二维码页面重试');
        }

        $this->validate($this->request, [
            'token' => 'required',
            'user_id'   => 'required'
        ], [
            'token.required' => 'token为必填字段',
            'user_id.required' => 'user_id为必填字段'
        ]);

        $data = $this->request->all();

        $code = $data['code'];

        $socialite = app('wechat');

        $driver = $socialite->driver('wechat')->scopes(['snsapi_userinfo']);

        $accessToken = $driver->getAccessToken($code);

        $response = $driver->user($accessToken);

        $userInfo = $response->getOriginal();

        $openid = $userInfo['openid'];

        $uid = $this->request->input('user_id');

        $userBind = WechatUser::where('openid', $openid)->update(['user_id' => $uid]);

        if ($userBind)
        {
            $this->withCode(200)->withMessage('绑定成功');
        } else {
            $this->withCode(402)->withMessage('绑定失败，稍后重试');
        }
    }
}