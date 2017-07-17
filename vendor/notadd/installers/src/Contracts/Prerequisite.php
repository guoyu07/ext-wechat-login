<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-08-27 17:01
 */
namespace Notadd\Installer\Contracts;

/**
 * Interface PrerequisiteContract.
 */
interface Prerequisite
{
    /**
     * Checking prerequisite's rules.
     *
     * @return mixed
     */
    public function check();

    /**
     * Get prerequisite's error message.
     *
     * @return mixed
     */
    public function getMessages();
}
