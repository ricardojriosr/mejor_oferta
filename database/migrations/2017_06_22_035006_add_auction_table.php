<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('auction', function (Blueprint $table) {
             $table->increments('id');
             $table->string('description');
             $table->string('warranty');
             $table->decimal('price',10,2);
             $table->integer('user_id')->unsigned();
             $table->integer('article_id')->unsigned();
             $table->timestamps();
             $table->foreign('article_id')->references('id')->on('article')
                 ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('user_id')->references('id')->on('users')
                 ->onUpdate('cascade')->onDelete('cascade');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('auction');
     }
}
