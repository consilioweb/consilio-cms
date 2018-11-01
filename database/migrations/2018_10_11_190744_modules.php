<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('modules_id');
            $table->string('module');
            $table->integer('type_module')->nullable();            

            $table->string('title')->nullable(); 
            $table->string('subtitle')->nullable();  
            $table->string('featured')->nullable();  
            $table->string('category')->nullable();  
            $table->string('featured_image')->nullable();  
            $table->string('summary')->nullable();  
            $table->string('content')->nullable();  
            $table->string('credit_author')->nullable();  
            $table->string('tags')->nullable();  
            $table->string('initial_date')->nullable();  
            $table->string('end_date')->nullable();  
            $table->string('starting_time')->nullable();  
            $table->string('end_time')->nullable();  
            $table->string('publication_date')->nullable();  
            $table->string('amount_1')->nullable();  
            $table->string('amount_2')->nullable();  
            $table->string('amount_3')->nullable();  
            $table->string('check_1')->nullable();  
            $table->string('check_2')->nullable();  
            $table->string('check_3')->nullable();  

            $table->integer('external_link')->nullable();
            $table->integer('optimization_seo')->nullable();
            $table->integer('image_gallery')->nullable();
            $table->integer('video_gallery')->nullable();
            $table->integer('file_gallery')->nullable();
            $table->integer('notifications')->nullable();


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
        Schema::dropIfExists('modules');
    }
}
