<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-19 下午5:20
 */
namespace Notadd\WechatLogin\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\WechatLogin\Models\LoginStatus;
use Notadd\WechatLogin\Models\WechatUser;

/**
 * Class BindCallbackHandler.
 */
class BindCallbackHandler extends Handler
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
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
        try {
            WechatUser::updateOrCreate(['openid' => $userInfo['openid']], $userInfo);
        } catch (\Exception $exception) {
            return $exception;
        }
        $token = $data['token'];
        $openid = $userInfo['openid'];
        LoginStatus::query()->where('token', $token)->update(['status' => 2, 'openid' => $openid, 'ip' => $this->request->getClientIp()]);


        $login = LoginStatus::query()->where('token', $token)->update([
            'status' => 2,
            'openid' => $openid,
            'ip'     => $this->request->getClientIp(),
        ]);
        $uid = $this->request->input('user_id');
        WechatUser::query()->where('openid', $openid)->update(['user_id' => $uid]);
    }
}