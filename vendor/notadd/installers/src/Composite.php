<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-08-27 18:48
 */
namespace Notadd\Installer;

use Notadd\Installer\Contracts\Prerequisite;

/**
 * Class Composite.
 */
class Composite implements Prerequisite
{
    /**
     * @var array
     */
    protected $prerequisites = [];

    /**
     * Composite constructor.
     *
     * @param \Notadd\Installer\Contracts\Prerequisite $first
     */
    public function __construct(Prerequisite $first)
    {
        foreach (func_get_args() as $prerequisite) {
            $this->prerequisites[] = $prerequisite;
        }
    }

    /**
     * Checking prerequisites's rules.
     *
     * @return mixed
     */
    public function check()
    {
        return array_reduce($this->prerequisites, function ($previous, Prerequisite $prerequisite) {
            return $prerequisite->check() && $previous;
        }, true);
    }

    /**
     * Get prerequisite's error message.
     *
     * @return mixed
     */
    public function getMessages()
    {
        return collect($this->prerequisites)->map(function (Prerequisite $prerequisite) {
            return $prerequisite->getMessages();
        })->reduce('array_merge', []);
    }
}
