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

class WechatUser extends Model
{
    protected $table = 'wechat_users';

    protected $fillable = [
        'openid',
        'user_id',
        'nickname',
        'province',
        'city',
        'language',
        'country',
        'headimgurl',
        'sex'
    ];

    public function userInfo()
    {
        return $this->hasOne('Notadd\Foundation\Member\Member', 'id', 'user_id');
    }
}
