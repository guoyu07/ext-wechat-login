<?php
/**
 * This file is part of Notadd.
 *
 * @author        linxing <linxing@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 上午10:25
 */


namespace Notadd\WechatLogin\Listeners;


use Notadd\WechatLogin\Controllers\TestController;

use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
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
            $this->router->any('test', TestController::class . '@test');

            $this->router->any('callback', TestController::class . '@callback');
        });
    }
}
