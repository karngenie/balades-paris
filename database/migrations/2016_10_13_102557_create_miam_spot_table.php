<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiamSpotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('miam_spot', function(Blueprint $table) {
            //$table->increments('id');

            $table->integer('miam_id')->unsigned();
            $table->integer('spot_id')->unsigned();
            $table->primary(['miam_id', 'spot_id']);
            $table->foreign('miam_id')->references('id')->on('miams')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');

            $table->foreign('spot_id')->references('id')->on('spots')
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
        Schema::table('miam_spot', function(Blueprint $table) {
            $table->dropForeign('miam_spot_miam_id_foreign');
            $table->dropForeign('miam_spot_spot_id_foreign');
        });

        Schema::drop('miam_spot');
    }
}
