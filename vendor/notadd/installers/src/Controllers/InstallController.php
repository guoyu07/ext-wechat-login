<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-08-27 18:36
 */
namespace Notadd\Installer\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;

/**
 * Class InstallController.
 */
class InstallController extends Controller
{
    /**
     * Index handler.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->view('install::install');
    }
}
