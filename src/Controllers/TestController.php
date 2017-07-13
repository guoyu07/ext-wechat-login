<?php

/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-13 下午4:40
 */
namespace Notadd\WechatLogin\Controllers;

use Notadd\Foundation\Application;
use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\WechatLogin\Handlers\TestHandler;
use Notadd\WechatLogin\Wechat;


class TestController extends Controller
{
    public function test(TestHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}