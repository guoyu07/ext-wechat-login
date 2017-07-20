<?php
/**
 * This file is part of Notadd.
 *
 * @author        linxing <linxing@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 上午10:25
 */


namespace Notadd\WechatLogin\Listeners;


use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Notadd\WechatLogin\Controllers\WechatOpenController;

/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Registrar.
     */
    public function handle()
    {
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/wechat'], function () {

            $this->router->any('auth', WechatOpenController::class . '@auth');

            $this->router->any('login', WechatOpenController::class . '@login');

            $this->router->any('callback', WechatOpenController::class . '@callback');

            $this->router->post('set', WechatOpenController::class . '@set');

            $this->router->post('get', WechatOpenController::class . '@get');

            $this->router->post('query', WechatOpenController::class . '@query');

            $this->router->post('bind', WechatOpenController::class . '@bind');

            $this->router->any('bindcallback', WechatOpenController::class . '@bindCallback');

            $this->router->any('bindquery', WechatOpenController::class . '@bindCallback');

        });
    }
}
