<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-13 下午5:10
 */

namespace Notadd\WechatLogin;


class Wechat
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;
    /**
     * The array of created "drivers".
     *
     * @var array
     */
    protected $drivers = [];

    /**
     *  The $config
     */
    protected $config;

    /**
     *
     * The driver is the selected pay-driver;
     *
     */

    protected $wechatLogin;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function test()
    {
        $this->wechatLogin = $this->app->make('wechatLogin');
        dd($this->wechatLogin);
    }


}