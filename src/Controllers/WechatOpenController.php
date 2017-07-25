<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-13 下午4:40
 */
namespace Notadd\WechatLogin\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\WechatLogin\Handlers\BindCallbackHandler;
use Notadd\WechatLogin\Handlers\BindHandler;
use Notadd\WechatLogin\Handlers\BindQueryHandler;
use Notadd\WechatLogin\Handlers\FrontAuthHandler;
use Notadd\WechatLogin\Handlers\BackAuthHandler;
use Notadd\WechatLogin\Handlers\GetConfHandler;
use Notadd\WechatLogin\Handlers\QueryHandler;
use Notadd\WechatLogin\Handlers\SetConfHandler;
use Notadd\WechatLogin\Handlers\CallbackHandler;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WechatOpenController.
 */
class WechatOpenController extends Controller
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * @param \Notadd\WechatLogin\Handlers\FrontAuthHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function auth(FrontAuthHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\BindHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function bind(BindHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\BindCallbackHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function bindCallback(BindCallbackHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\BindQueryHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function bindQuery(BindQueryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\BackAuthHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function login(BackAuthHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\QueryHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function query(QueryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\CallbackHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function callback(CallbackHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\GetConfHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function get(GetConfHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Notadd\WechatLogin\Handlers\SetConfHandler $handler
     * @param \Symfony\Component\HttpFoundation\Request   $request
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function set(SetConfHandler $handler, Request $request)
    {
        $this->validate($request, [
            'app_id'     => 'required|regex:/(?!^\d+$)(?!^[a-zA-Z]+$)[0-9a-zA-Z]{18}$/',
            'app_secret' => 'required|regex:/(?!^\d+$)(?!^[a-zA-Z]+$)[0-9a-zA-Z]{32}$/',
        ], [
            'app_id.required'     => 'app_id不能为空',
            'app_id.regex'        => 'app_id必须为18位数字,字母组成的字符串(不含特殊字符)',
            'app_secret.required' => 'app_secret不能为空',
            'app_secret.regex'    => 'app_secret必须为为32位数字,字母组成的字符串(不含特殊字符)',
        ]);

        return $handler->toResponse()->generateHttpResponse();
    }
}