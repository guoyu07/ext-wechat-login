<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-11 18:24
 */
namespace Notadd\Installer\Commands;

use Notadd\Foundation\Console\Abstracts\Command;
use Notadd\Foundation\Member\Member;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class IntegrationCommand.
 */
class IntegrationCommand extends Command
{

    /**
     * Configure command.
     */
    protected function configure()
    {
        $this->setDescription('Run notadd\'s integration testing');
        $this->setName('integration');
    }

    public function fire()
    {
        $this->call('migrate', [
            '--force' => true,
        ]);

        $this->call('passport:keys');
        $this->call('passport:client', [
            '--password' => true,
            '--name'     => 'Notadd Administrator Client',
        ]);

        $this->call('vendor:publish', [
            '--force' => true,
        ]);

        $setting = $this->container->make(SettingsRepository::class);
        $setting->set('application.version', $this->container->version());
        $setting->set('site.enabled', true);
        $setting->set('site.name', 'Notadd');
        $setting->set('setting.image.engine', 'normal');
        $setting->set('module.notadd/administration.enabled', true);

        Member::query()->create([
            'name'     => 'admin',
            'email'    => 'admin@notadd.com',
            'password' => bcrypt('123qwe'),
        ]);

        $this->call('key:generate');
        touch($this->container->storagePath() . DIRECTORY_SEPARATOR . 'installed');
        $this->info('Notadd Installed!');
    }
}
