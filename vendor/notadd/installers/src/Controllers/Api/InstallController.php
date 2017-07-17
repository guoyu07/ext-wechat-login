<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-03-03 16:25
 */
namespace Notadd\Installer\Controllers\Api;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Installer\Handlers\CheckHandler;
use Notadd\Installer\Handlers\DatabaseHandler;
use Notadd\Installer\Handlers\InstallHandler;

/**
 * Class InstallController.
 */
class InstallController extends Controller
{
    /**
     * Checking handler.
     *
     * @param \Notadd\Installer\Handlers\CheckHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function check(CheckHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Database handler.
     *
     * @param \Notadd\Installer\Handlers\DatabaseHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function database(DatabaseHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Install handler.
     *
     * @param \Notadd\Installer\Handlers\InstallHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function install(InstallHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
