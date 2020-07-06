<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('acc_id');
            $table->string('account', 100)->nullable()->default('');
            $table->string('password', 100)->nullable()->default('');
            $table->rememberToken();
            $table->integer('status')->unsigned()->nullable()->default(0)->comment('1=啟用,2=刪除,3=禁用');
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
        Schema::dropIfExists('accounts');
    }
}
