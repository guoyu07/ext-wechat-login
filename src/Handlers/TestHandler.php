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

class TestHandler extends Handler
{
    protected $wechat;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->wechat = $this->container->make('wechatLogin');
    }

    public function execute()
    {

    }
}