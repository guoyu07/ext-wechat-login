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
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WechatUser.
 */
class WechatUser extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'wechat_users';

    /**
     * @var array
     */
    protected $fillable = [
        'openid',
        'user_id',
        'nickname',
        'province',
        'city',
        'language',
        'country',
        'headimgurl',
        'sex',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userInfo()
    {
        return $this->hasOne('Notadd\Foundation\Member\Member', 'id', 'user_id');
    }
}
