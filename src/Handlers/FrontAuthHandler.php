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
use Notadd\WechatLogin\help;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use Notadd\WechatLogin\Models\LoginStatus;

class FrontAuthHandler extends Handler
{
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
        $token = help::getToken();

        $login = new LoginStatus();

        $login->token = $token;

        $login->status = 1;//status = 1 代表该用户暂未扫描二维码登陆

        $saveResult = $login->save();

        if (!$saveResult) {
            $this->withCode(402)->withError('保存token失败，请稍候重试');
        }

        $socialite = $this->container->make('wechat');

        $driver = $socialite->driver('wechat')->scopes(['snsapi_userinfo']);

        $redirectUrl = url('/api/wechat/callback') . '?token=' . $token;

        $response = $driver->setRedirectUrl($redirectUrl)->redirect();

        $url = $response->getTargetUrl();

        return $this->withCode(200)->withData(['url' => $url, 'token' => $token])->withMessage('获取授权路径成功');
    }
}