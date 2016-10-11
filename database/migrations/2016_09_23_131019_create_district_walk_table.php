<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictWalkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_walk', function(Blueprint $table) {
            //$table->increments('id');

            $table->integer('district_id')->unsigned();
            $table->integer('walk_id')->unsigned();
            $table->primary(['district_id', 'walk_id']);
            $table->foreign('district_id')->references('id')->on('districts')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');

            $table->foreign('walk_id')->references('id')->on('walks')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('district_walk', function(Blueprint $table) {
            $table->dropForeign('district_walk_district_id_foreign');
            $table->dropForeign('district_walk_walk_id_foreign');
        });

        Schema::drop('district_walk');
    }
}
