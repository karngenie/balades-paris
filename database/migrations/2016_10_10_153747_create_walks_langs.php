<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalksLangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walks_langs', function(Blueprint $table) {
            $table->integer('walk_id')->unsigned();
            $table->string('lang_code', 5);
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->longText('desc');
            $table->timestamps();
            $table->primary(['walk_id', 'lang_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('walks_langs');
    }
}
