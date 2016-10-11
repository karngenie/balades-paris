<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalksContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walks_contents', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('walk_id')->unsigned()->nullable();
            $table->foreign('walk_id')
                  ->references('id')
                  ->on('walks')
                  ->onDelete('restrict')
                  ->onUpdate('restrict'); 
            $table->integer('spot_id')->unsigned()->nullable();
            $table->integer('ranking')->unsigned()->nullable();
            $table->foreign('spot_id')
                  ->references('id')
                  ->on('spots')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

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
        Schema::drop('walks_contents');
    }
}
