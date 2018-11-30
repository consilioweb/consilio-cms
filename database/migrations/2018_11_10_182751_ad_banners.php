<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_banners', function (Blueprint $table) {
            $table->increments('ad_banners_id');
            $table->integer('ad_clients_id')->unsigned();
            $table->integer('ad_locations_id')->unsigned();
            $table->integer('type')->unsigned();
            $table->string('title');
            $table->integer('price')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('code')->nullable();
            $table->text('code_google')->nullable();
            $table->string('file')->nullable();
            $table->string('url')->nullable();
            $table->integer('click')->nullable();
            $table->integer('view')->nullable();
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
        Schema::dropIfExists('ad_banners');
    }
}
