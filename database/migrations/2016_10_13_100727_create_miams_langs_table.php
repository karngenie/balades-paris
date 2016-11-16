<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiamsLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miams_langs', function(Blueprint $table) {
            $table->integer('miam_id')->unsigned();
            $table->string('lang_code', 5);
            $table->string('name', 100);
            $table->longText('desc');
            $table->string('url', 4000);
            $table->timestamps();
            $table->primary(['miam_id', 'lang_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('miams_langs');
    }
}
