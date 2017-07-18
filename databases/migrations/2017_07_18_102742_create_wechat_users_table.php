<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-07-18 10:27:42
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateWechatUsersTable.
 */
class CreateWechatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('wechat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            $table->integer('user_id')->nullable();
            $table->string('nickname');
            $table->smallInteger('sex')->comment('0保密,1男,2女');
            $table->string('language');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('headimgurl');
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
        $this->schema->drop('wechat_users');
    }
}
