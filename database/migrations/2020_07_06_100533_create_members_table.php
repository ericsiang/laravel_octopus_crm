<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('mem_id');
            $table->string('card_num', 20)->nullable()->default('')->unique()->comment('卡號');
            $table->string('cid', 10)->nullable()->default('')->comment('頻道代碼');
            $table->string('name', 50)->nullable()->default('')->comment('姓名');
            $table->string('email', 100)->nullable()->default('')->unique()->comment('信箱');
            $table->string('password', 100)->nullable()->default('')->comment('密碼');
            $table->string('phone', 50)->nullable()->default('')->comment('電話');
            $table->tinyInteger('sex')->default(0)->comment('性別 1=男 2=女');
            $table->bigInteger('city_id')->unsigned()->comment('縣市ID');
            $table->bigInteger('area_id')->unsigned()->comment('區域ID');
            $table->string('address', 100)->nullable()->default('')->comment('地址');
            $table->tinyInteger('email_auth')->default(2)->comment('是否驗證 1=有驗證 2=無驗證');
            $table->integer('points')->default(0)->comment('紅利點數');
            $table->integer('level')->default(0)->comment('會員等級');
            $table->string('fb_id', 50)->nullable()->default('')->comment('facebook代號');
            $table->string('google_id', 50)->nullable()->default('')->comment('google代號');
            $table->tinyInteger('status')->default(0)->comment('是否啟用 1=啟用 2=禁用 3=刪除');
            $table->softDeletes();
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
        Schema::dropIfExists('members');
    }
}
