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
        $config = [
            'wechat' => [
                'client_id'     => 'wx2dd40b5b1c24a960',
                'client_secret' => 'd5232b1aadd5ba1b5d1352a4c537c4f1',
                'redirect'      => 'https://allen.ibenchu.pw/api/wechat/callback'
            ]
        ];
        $login = new SocialiteManager($config);

        $response = $login->driver('wechat')->redirect();

        dd($response);
    }
}