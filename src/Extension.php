<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:36
 */
namespace Notadd\WechatLogin;

use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;
use Overtrue\Socialite\SocialiteManager;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class Extension.
 */
class Extension extends AbstractExtension
{
    /**
     * Boot provider.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), '');
        $this->publishes([
            realpath(__DIR__ . '/../resources/mixes/administration/dist/assets/extensions/notadd/wechat-login') => public_path('assets/extensions/notadd/wechat-login'),
        ], 'public');
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../databases/migrations'));
    }

    /**
     * Installer for extension.
     *
     * @return \Closure
     */
    public static function install()
    {
        return function () {
            return true;
        };
    }

    /**
     * Get script of extension.
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function script()
    {
        return asset('assets/extensions/notadd/wechat-login/js/extension.min.js');
    }

    /**
     * Get stylesheet of extension.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function stylesheet()
    {
        return [
            asset('assets/extensions/notadd/wechat-login/css/extension.min.css')
        ];
    }

    /**
     * Uninstall for extension.
     *
     * @return \Closure
     */
    public static function uninstall()
    {
        return function () {
            return true;
        };
    }

    public function register()
    {
        $settings = $this->app->make(SettingsRepository::class);

        $this->app->singleton('wechat', function () use ($settings) {

            $config = [
                'wechat' => [
                    'client_id'     => $settings->get('wechatLogin.app_id', false),
                    'client_secret' => $settings->get('wechatLogin.app_secret', false),
                    'redirect'      => ''
                ]
            ];
            return new SocialiteManager($config);
        });
    }

}
