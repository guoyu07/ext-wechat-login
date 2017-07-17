<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-10-24 10:49
 */
namespace Notadd\Installer;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Notadd\Foundation\Http\Abstracts\ServiceProvider;
use Notadd\Installer\Commands\InstallCommand;
use Notadd\Installer\Commands\IntegrationCommand;
use Notadd\Installer\Commands\IntegrationConfigurationCommand;
use Notadd\Installer\Contracts\Prerequisite;
use Notadd\Installer\Controllers\Api\InstallController as InstallApiController;
use Notadd\Installer\Controllers\InstallController;
use Notadd\Installer\Listeners\CsrfTokenRegister;
use Notadd\Installer\Prerequisite\PhpExtension;
use Notadd\Installer\Prerequisite\PhpVersion;
use Notadd\Installer\Prerequisite\WritablePath;

/**
 * Class InstallServiceProvider.
 */
class InstallerServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Events\Dispatcher
     */
    protected $dispatcher;

    /**
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * InstallerServiceProvider constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->dispatcher = $app[Dispatcher::class];
        $this->router = $app[Router::class];
    }

    /**
     * Boot service provider.
     */
    public function boot()
    {
        if (!$this->app->isInstalled()) {
            $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
            $this->app->make('router')->resource('/', InstallController::class, [
                'only' => 'index',
            ]);
            $this->app->make('router')->group(['middleware' => ['cross'], 'prefix' => 'api'], function () {
                $this->app->make('router')->post('check', InstallApiController::class . '@check');
                $this->app->make('router')->post('database', InstallApiController::class . '@database');
                $this->app->make('router')->post('install', InstallApiController::class . '@install');
            });
        }
        $this->commands([
            InstallCommand::class,
            IntegrationCommand::class,
            IntegrationConfigurationCommand::class,
        ]);
        $this->loadViewsFrom(realpath(__DIR__ . '/../resources/views'), 'install');
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'install');
        $this->publishes([
            realpath(__DIR__ . '/../resources/mixes/dist/assets/install') => public_path('assets/install'),
        ]);
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        $this->app->singleton(Prerequisite::class, function () {
            return new Composite(new PhpVersion('5.6.28'), new PhpExtension([
                'dom',
                'fileinfo',
                'gd',
                'json',
                'mbstring',
                'openssl',
                'pdo_mysql',
            ]), new WritablePath([
                public_path(),
                storage_path(),
            ]));
        });
    }
}
