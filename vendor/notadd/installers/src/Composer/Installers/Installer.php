<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-12-03 13:55
 */
namespace Notadd\Installer\Composer\Installers;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class Installer.
 */
class Installer extends LibraryInstaller
{
    /**
     * Get install path for Composer Installer.
     *
     * @param \Composer\Package\PackageInterface $package
     *
     * @return string
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $name) = explode('/', $package->getPrettyName());

        return 'modules/' . $name;
    }

    /**
     * Confirm supported Package Types.
     *
     * @param $packageType
     *
     * @return bool
     */
    public function supports($packageType)
    {
        return $packageType === 'notadd-module';
    }
}
