<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-08-27 17:18
 */
namespace Notadd\Installer\Prerequisite;

use Notadd\Installer\Abstracts\Prerequisite;

/**
 * Class WritablePath.
 */
class WritablePath extends Prerequisite
{
    /**
     * @var array
     */
    protected $paths;

    /**
     * WritablePath constructor.
     *
     * @param array $paths
     */
    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    /**
     * Checking prerequisite's rules.
     */
    public function check()
    {
        $isWritable = collect();
        $notWritable = collect();
        foreach ($this->paths as $path) {
            if (!is_writable($path)) {
                $notWritable->push(realpath($path));

            } else {
                $isWritable->push(realpath($path));

            }
        }
        $isWritable->count() && $this->messages[] = [
            'type' => 'message',
            'message' => "目录权限检测通过，路径 '" . $isWritable->implode("', '") . "' 可写。",
        ];
        $notWritable->count() && $this->messages[] = [
            'type' => 'error',
            'detail' => '',
            'help' => '',
            'message' => "目录 '" . $notWritable->implode("', '") . "' 不可写！",
        ];
    }
}
