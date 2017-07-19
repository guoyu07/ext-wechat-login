<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-07-18 14:38:08
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateWechatAdminTable.
 */
class CreateWechatLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('wechat_login', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token', 32);
            $table->string('openid')->nullable();
            $table->smallInteger('status')->comment('1:等待登陆,2:登陆成功,3:已通知');
            $table->string('ip')->nullable();
            $table->string('client')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('wechat_login');
    }
}
