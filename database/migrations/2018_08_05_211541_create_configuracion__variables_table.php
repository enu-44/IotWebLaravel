<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion__variables', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('coreid_configure')->nullable();
            $table->string('name_configure')->nullable();
            $table->string('alias_variable')->nullable();


            $table->bigInteger('dispositivo_id')->unsigned();
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos');

             $table->bigInteger('tipo_variable_id')->unsigned();
            $table->foreign('tipo_variable_id')->references('id')->on('tipo__variables');

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
        Schema::dropIfExists('configuracion__variables');
    }
}
