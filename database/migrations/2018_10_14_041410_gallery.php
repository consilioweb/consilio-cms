<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('gallery_id');
            $table->integer('modules_id')->unsigned();
            $table->integer('contents_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('legend')->nullable();
            $table->string('file');
            $table->string('type')->nullable();
            $table->string('extension')->nullable();
            
            $table->integer('insert_users_id')->nullable();
            $table->integer('update_users_id')->nullable();
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
        Schema::dropIfExists('gallery');
    }
}
