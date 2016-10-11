<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsLangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts_langs', function(Blueprint $table) {
            $table->integer('district_id')->unsigned();
            $table->string('lang_code', 5);
            $table->string('name', 50);
            $table->string('name_short', 10);
            $table->longText('desc');          
            $table->timestamps();
            $table->primary(['district_id', 'lang_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('districts_langs');
    }
}
