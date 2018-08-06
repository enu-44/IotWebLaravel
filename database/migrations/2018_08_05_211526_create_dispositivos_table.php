<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('coords_dispositivo');
            $table->string('mac')->nullable();
            $table->string('marca')->nullable();
            $table->string('descripcion_dispositivo')->nullable();
            $table->boolean('cellular')->default(false);
            $table->boolean('connected')->default(false);
            $table->string('current_build_target')->nullable();
            $table->string('id_externo')->nullable();
            $table->string('imei')->nullable();
            $table->string('last_app')->nullable();
            $table->string('last_heard')->nullable();
            $table->string('last_iccid')->nullable();
            $table->string('last_ip_address')->nullable();
            $table->string('name')->nullable();
            $table->string('platform_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('status')->nullable();

            $table->bigInteger('tipo_dispositivo_id')->unsigned();
            $table->foreign('tipo_dispositivo_id')->references('id')->on('tipo__dispositivos');

            $table->bigInteger('unidad_productiva_id')->unsigned();
            $table->foreign('unidad_productiva_id')->references('id')->on('unidad__productivas');

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
        Schema::dropIfExists('dispositivos');
    }
}


