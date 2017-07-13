<?php

/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-13 下午5:30
 */
namespace Notadd\WechatLogin\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Illuminate\Container\Container;
use Overtrue\Socialite\SocialiteManager;


class TestHandler extends Handler
{
    protected $login;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    public function execute()
    {

        $login = new SocialiteManager();
    }
}