<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-12-03 13:49
 */
namespace Notadd\Installer\Composer;

use Composer\Composer;
//use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
//use Composer\Plugin\PluginEvents;
use Composer\Plugin\PluginInterface;
use Notadd\Installer\Composer\Installers\Installer;

/**
 * Class Plugin.
 */
class Plugin implements /*EventSubscriberInterface, */PluginInterface
{
    /**
     * @var \Composer\Composer
     */
    protected $composer;

    /**
     * @var \Composer\IO\IOInterface
     */
    protected $io;

    /**
     * Add installer to Composer Installation Manager.
     *
     * @param \Composer\Composer       $composer
     * @param \Composer\IO\IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        $installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     * The array keys are event names and the value can be:
     * * The method name to call (priority defaults to 0)
     * * An array composed of the method name to call and the priority
     * * An array of arrays composed of the method names to call and respective
     *   priorities, or 0 if unset
     * For instance:
     * * array('eventName' => 'methodName')
     * * array('eventName' => array('methodName', $priority))
     * * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
//    public static function getSubscribedEvents()
//    {
//        return [
//            PluginEvents::INIT => 'onInit',
//        ];
//    }
}
