<?php
/**
 * The file is part of Notadd
 *
 * @author: AllenGu<674397601@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-7-18 上午10:56
 */
namespace Notadd\WechatLogin\Models;

use Notadd\Foundation\Database\Model;

/**
 * Class LoginStatus.
 */
class LoginStatus extends Model
{
    /**
     * @var string
     */
    protected $table = 'wechat_login';

    /**
     * @var array
     */
    protected $fillable = [
        'openid',
        'token',
        'status',
        'ip',
        'client',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(WechatUser::class, 'openid', 'openid');
    }
}
