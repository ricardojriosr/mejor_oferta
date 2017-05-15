<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category', function($table) {
            $table->string('slug')->unique();
        });
        Schema::table('subcategory', function($table) {
            $table->string('slug')->unique();
        });
        Schema::table('article', function($table) {
            $table->dropColumn('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function($table) {
            $table->dropColumn('slug');
        });
        Schema::table('subcategory', function($table) {
            $table->dropColumn('slug');
        });
        Schema::table('article', function($table) {
            $table->dropColumn('slug');
        });
    }
}
