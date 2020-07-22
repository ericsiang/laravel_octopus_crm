<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mem_id')->unsigned();
            $table->integer('calculation')->default(0)->comment('0預設 1加 2減');
            $table->integer('point')->nullable()->default(0)->comment('點數');
            $table->mediumText('message')->nullable()->comment('備註');
            $table->timestamps();
            $table->index('mem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_logs');
    }
}
