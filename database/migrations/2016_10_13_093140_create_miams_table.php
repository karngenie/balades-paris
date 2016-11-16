<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miams', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')
                  ->references('id')
                  ->on('districts')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');        
            $table->string('img');
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
        Schema::drop('miams');
    }
}
