<?php

/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-18 上午10:56
 */

namespace Notadd\WechatLogin\Models;

use Illuminate\Database\Eloquent\Model;

class LoginStatus extends Model
{
    protected $table = 'wechat_login';

    protected $fillable = ['openid', 'token', 'status', 'ip', 'client'];

    public function user()
    {
        return $this->hasOne('Notadd\WechatLogin\Models\WechatUser', 'openid', 'openid');
    }

}
