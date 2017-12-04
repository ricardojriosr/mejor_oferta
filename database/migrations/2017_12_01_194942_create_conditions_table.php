<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condition', function (Blueprint $table) {
            $table->increments('id');
            $table->string('condition');
            $table->timestamps();
        });

        Schema::create('offer', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price',10,2)->default(0.00);
            $table->integer('condition_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->string('observations')->nullable();
            $table->string('warranty')->nullable();
            $table->timestamps();
            $table->foreign('condition_id')->references('id')->on('conditions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('conditions');
        Schema::dropIfExists('offers');
    }
}
