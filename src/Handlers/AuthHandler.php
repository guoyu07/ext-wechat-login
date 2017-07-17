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
use Notadd\Foundation\Setting\Contracts\SettingsRepository;


class AuthHandler extends Handler
{
    protected $login;

    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);

        $this->settings = $settings;
    }

    public function execute()
    {
        $config = [
            'wechat' => [
                'client_id'     => $this->settings->get('wechatLogin.app_id', false),
                'client_secret' => $this->settings->get('wechatLogin.app_secret', false),
                'redirect'      => 'https://allen.ibenchu.pw/api/wechat/callback'
            ]
        ];

        $login = new SocialiteManager($config);

        $driver = $login->driver('wechat');

        $response = $driver->scopes(['snsapi_userinfo'])->redirect();

        dd($response);

    }
}