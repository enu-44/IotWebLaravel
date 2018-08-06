<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadProductivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad__productivas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_unidad_productiva');
            $table->string('description_unidad_productiva');
            $table->string('nit_unidad_productiva')->nullable();
            
            $table->string('direccion_unidad_productiva')->nullable();
            $table->string('path_unidad_productiva')->nullable();
            $table->string('marker')->nullable();
            $table->string('poligono')->nullable();
            $table->string('rectangulo')->nullable();
            $table->string('circulo')->nullable();
            $table->string('radius')->nullable();

            $table->string('ciudad')->nullable();
            $table->string('departamento')->nullable();

            $table->bigInteger('proyecto_id')->unsigned()->nullable();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');

            

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
        Schema::dropIfExists('unidad__productivas');
    }
}
