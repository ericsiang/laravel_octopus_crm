<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('area_list', function (Blueprint $table) {
            $table->bigIncrements('area_id');
            $table->bigInteger('city_id')->unsigned()->nullable()->comment('縣市ID');
            $table->string('area', 10)->nullable()->default('');
            $table->string('zip', 10)->nullable()->default('');
            $table->timestamps();
        });
       
        Schema::table('area_list', function($table) {
            $table->foreign('city_id')->references('city_id')->on('city_list');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_list');
    }
}
