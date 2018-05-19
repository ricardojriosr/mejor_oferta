<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptedOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accepted_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned()->unique();
            $table->integer('article_id')->unsigned()->unique();
            $table->timestamps();
            $table->foreign('offer_id')->references('id')->on('offer')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('article')
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
          Schema::drop('accepted_offers');
    }
}
