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
            $result = WechatUser::updateOrCreate(['openid' => $userInfo['openid']], $userInfo);
        } catch (\Exception $exception) {
            dd($exception);
        }
        $token = $data['token'];
        $openid = $userInfo['openid'];
        $login = LoginStatus::where('token', $token)->update([
            'status' => 2,
            'openid' => $openid,
            'ip'     => $this->request->getClientIp(),
        ]);
        $uid = $this->request->input('user_id');
        $userBind = WechatUser::where('openid', $openid)->update(['user_id' => $uid]);
    }
}