<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-11 18:38
 */
namespace Notadd\Installer\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Notadd\Foundation\Console\Abstracts\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;

/**
 * Class IntegrationConfigurationCommand.
 */
class IntegrationConfigurationCommand extends Command
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * IntegrationConfigurationCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function configure()
    {
        $this->addOption('driver', null, InputOption::VALUE_REQUIRED, 'Database driver, such as mysql, pgsql, sqlite.');
        $this->addOption('host', null, InputOption::VALUE_REQUIRED, 'Database host.');
        $this->addOption('port', null, InputOption::VALUE_REQUIRED, 'Database port.');
        $this->addOption('database', null, InputOption::VALUE_REQUIRED, 'Database name.');
        $this->addOption('username', null, InputOption::VALUE_REQUIRED, 'Database username.');
        $this->addOption('password', null, InputOption::VALUE_OPTIONAL, 'Database password.');
        $this->addOption('prefix', null, InputOption::VALUE_REQUIRED, 'Database prefix.');
        $this->setName('integration:configuration');
    }

    public function fire()
    {
        $file = $this->container->environmentFilePath();
        $this->files->exists($file) || touch($file);
        $database = new Collection($this->container->make(Yaml::class)->parse(file_get_contents($file)));
        $database->put('DB_CONNECTION', $this->input->getOption('driver'));
        $database->put('DB_HOST', $this->input->getOption('host'));
        $database->put('DB_PORT', $this->input->getOption('port'));
        $database->put('DB_DATABASE', $this->input->getOption('driver') == 'sqlite' ? $this->container->storagePath() . DIRECTORY_SEPARATOR . 'bootstraps' . DIRECTORY_SEPARATOR . 'database.sqlite' : $this->input->getOption('database'));
        $database->put('DB_USERNAME', $this->input->getOption('username'));
        $database->put('DB_PASSWORD', $this->input->getOption('password') ?: '');
        $database->put('DB_PREFIX', $this->input->getOption('prefix'));

        file_put_contents($file, $this->container->make(Yaml::class)->dump($database->toArray()));
    }
}
