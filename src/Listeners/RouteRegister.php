<?php
/**
 * This file is part of Notadd.
 *
 * @author        linxing <linxing@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      17-6-23 上午10:25
 */


namespace Notadd\Cloud\Listeners;

use Notadd\Cloud\Controllers\QiniuController;

use Notadd\Cloud\Controllers\UploadController;
use Notadd\Cloud\Controllers\UpyunController;
use Notadd\Cloud\Controllers\QueryController;
use Notadd\Cloud\Controllers\TestController;

use Notadd\Cloud\Handlers\UpyunReturnHandler;
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

        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/cloud'], function () {
            $this->router->post('upload_qiniu', UploadController::class . '@upload_qiniu');
            $this->router->get('upload_upyun', UploadController::class . '@upload_upyun');
            $this->router->post('upload', UploadController::class. '@upload');
            $this->router->post('list', UploadController::class. '@file_list');
            $this->router->post('read', UploadController::class. '@read');
            $this->router->post('thumb', UploadController::class. '@thumb');
            $this->router->post('data', UploadController::class. '@data');
            $this->router->post('search', QueryController::class. '@search');
            $this->router->post('groups', QueryController::class. '@groups');
            $this->router->post('details', QueryController::class. '@details');
            $this->router->post('new_group', QueryController::class. '@new_group');

//            $this->router->post('watertext', UploadController::class. '@watertext');
//            $this->router->post('waterimg', UploadController::class. '@waterimg');

            $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'qiniu'], function () {
                $this->router->post('set', QiniuController::class . '@set');
                $this->router->post('get', QiniuController::class . '@get');
                $this->router->post('set_thumb', QiniuController::class . '@set_thumb');
                $this->router->post('get_thumb', QiniuController::class . '@get_thumb');
            });

            $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'upyun'], function () {
                $this->router->post('set', UpyunController::class . '@set');
                $this->router->post('get', UpyunController::class . '@get');
                $this->router->post('return', UpyunController::class. '@callBack');
            });
        });

    }
}
