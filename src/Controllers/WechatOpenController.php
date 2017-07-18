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
use Notadd\WechatLogin\Handlers\FrontAuthHandler;
use Notadd\WechatLogin\Handlers\GetConfHandler;
use Notadd\WechatLogin\Handlers\SetConfHandler;
use Notadd\WechatLogin\Handlers\CallbackHandler;
use Symfony\Component\HttpFoundation\Request;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use Overtrue\Socialite\SocialiteManager;

class WechatOpenController extends Controller
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    public function auth(FrontAuthHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    public function returnUrl()
    {
        dd(1);
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
            'app_id' => 'required|regex:/(?!^\d+$)(?!^[a-zA-Z]+$)[0-9a-zA-Z]{18}$/',
            'app_secret' => 'required|regex:/(?!^\d+$)(?!^[a-zA-Z]+$)[0-9a-zA-Z]{32}$/',
        ], [
            'app_id.required' => 'app_id不能为空',
            'app_id.regex' => 'app_id必须为18位数字,字母组成的字符串(不含特殊字符)',
            'app_secret.required' => 'app_secret不能为空',
            'app_secret.regex' => 'app_secret必须为为32位数字,字母组成的字符串(不含特殊字符)'
        ]);

        return $handler->toResponse()->generateHttpResponse();
    }

}