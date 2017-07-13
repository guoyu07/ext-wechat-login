<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:36
 */
namespace Notadd\Cloud;

use Illuminate\Events\Dispatcher;
use Notadd\Cloud\Listeners\CsrfTokenRegister;
use Notadd\Cloud\Listeners\RouteRegister;
use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;
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
        $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
        $this->app->make(Dispatcher::class)->subscribe(RouteRegister::class);
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'cloud');
        $this->loadViewsFrom(realpath(__DIR__ . '/../resources/views'), 'cloud');
        $this->publishes([
            realpath(__DIR__ . '/../resources/mixes/administration/dist/assets/extensions/ext-cloud') => public_path('assets/extensions/ext-cloud'),
        ], 'public');
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../databases/migrations'));
    }

    /**
     * Description of extension
     *
     * @return string
     */
    public static function description()
    {
        return '云存储插件的配置和管理。';
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
     * Name of extension.
     *
     * @return string
     */
    public static function name()
    {
        return '云存储插件';
    }

    /**
     * Get script of extension.
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function script()
    {
        return asset('assets/extensions/cloud/js/extension.min.js');
    }

    /**
     * Get stylesheet of extension.
     *
     * @return array
     */
    public static function stylesheet()
    {
        return [];
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

    /**
     * Version of extension.
     *
     * @return string
     */
    public static function version()
    {
        return '0.1.0';
    }

//    public function register(){
//
//        $this->app->singleton('cloud',function ($app) {
//            return new Cloud($app);
//        });
//    }

    public function register()
    {
        return $this->registerCloud();
    }

    public function registerCloud()
    {
        $this->app->singleton('cloud', function ($app) {
            return new Cloud($app);
        });
    }

}
