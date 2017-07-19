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
use Notadd\WechatLogin\Models\LoginStatus;
use Notadd\WechatLogin\Models\WechatUser;

class QueryHandler extends Handler
{
    public function execute()
    {
        $this->validate($this->request, [
            'token' => 'required'
        ], [
            'token.required' => 'token为必填字段'
        ]);

        /**
         * verify the token's validity(5 min = 300s)
         */

        $token = $this->request->input('token');

        $timestamp = substr($token, 22);

        if (time() - $timestamp > 300) {
            $this->withCode(402)->withMessage('token失效，请刷新二维码页面重试');
        }

        $userInfo = LoginStatus::where('token', $token)->where('status', 2)->first()->user;


        if ($userInfo instanceof WechatUser) {
            $userInfo = $userInfo->toArray();
            $this->withCode(200)->withData($userInfo)->withMessage('获取用户微信详情成功');
        }

    }
}