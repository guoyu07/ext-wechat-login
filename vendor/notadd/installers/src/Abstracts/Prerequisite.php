<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-08-27 17:03
 */
namespace Notadd\Installer\Abstracts;

use Notadd\Installer\Contracts\Prerequisite as PrerequisiteContract;

/**
 * Class Prerequisite.
 */
abstract class Prerequisite implements PrerequisiteContract
{
    /**
     * @var array
     */
    protected $messages = [];

    /**
     * Checking prerequisite's rules.
     *
     * @return mixed
     */
    abstract public function check();

    /**
     * Get prerequisite's error message.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
