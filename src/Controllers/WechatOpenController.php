<?php

/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-13 下午4:40
 */
namespace Notadd\WechatLogin\Controllers;

use Illuminate\Support\Facades\Log;
use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\WechatLogin\Handlers\AuthHandler;
use Notadd\WechatLogin\Handlers\GetConfHandler;
use Notadd\WechatLogin\Handlers\SetConfHandler;
use Notadd\WechatLogin\Handlers\CallbackHandler;
use Notadd\WechatLogin\Wechat;
use Overtrue\Socialite\Providers\WeChatOpenPlatformProvider;
use Overtrue\Socialite\Providers\WeChatProvider;
use Symfony\Component\HttpFoundation\Request;

class WechatOpenController extends Controller
{
    public function auth(AuthHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    public function returnUrl()
    {
        $data = $this->request->all();
        Log::info($data);
    }

    public function callback(CallbackHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     *
     * @param \Notadd\WechatLogin\Handlers\GetConfHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function get(GetConfHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Set handler.
     *
     * @param \Notadd\WechatLogin\Handlers\SetConfHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */

    public function set(SetConfHandler $handler, Request $request)
    {
        $this->validate($request, [
            'app_id' => 'required',
            'app_secret' => 'required',
        ], [
            'app_id.required' => 'app_id不能为空',
            'app_secret.required' => 'app_secret不能为空',
        ]);

        return $handler->toResponse()->generateHttpResponse();
    }


}