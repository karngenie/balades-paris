<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          
           
        Schema::create('spots', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')
                  ->references('id')
                  ->on('districts')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            //todo faire table de lib
            $table->integer('spot_icon_id')->unsigned()->nullable();   
            $table->foreign('spot_icon_id')
                  ->references('id')
                  ->on('l_spots_icons')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');            
            //todo faire table de lib
            $table->integer('spot_type_id')->nullable();   // vrai spot spot_type_id=1 ou juste indication de parcours spot_type_id=2
            $table->string('pos_x');
            $table->string('pos_y');
            $table->boolean('show')->default(true);
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
        Schema::drop('spots');
    }
}
