<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Advertiser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser', function (Blueprint $table) {
            $table->increments('advertiser_id');
            $table->string('logo');
            $table->string('title');
            $table->string('phone');
            $table->string('email');
            $table->string('cnpj');
            $table->integer('priority')->unsigned();
            $table->integer('status')->unsigned();
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
        Schema::dropIfExists('advertiser');
    }
}
