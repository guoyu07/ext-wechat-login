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
use Notadd\WechatLogin\Handlers\TestHandler;
use Notadd\WechatLogin\Handlers\CallbackHandler;
use Notadd\WechatLogin\Wechat;


class TestController extends Controller
{
    public function test(TestHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
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

        ], [

        ]);
        return $handler->toResponse()->generateHttpResponse();
    }


}