<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-19 上午10:42
 */

namespace Notadd\WechatLogin;


use Illuminate\Support\Facades\Hash;

class Help
{
    public static function getToken()
    {
        $random = md5(random_int(0, 999999999));

        $pretoken = substr($random, 0, 22);

        $timestamp = (string)(time(date("Y-m-d H:i:s")));

        $token = $pretoken . $timestamp;

        return $token;
    }
}