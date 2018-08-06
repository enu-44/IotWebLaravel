<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('last_name');
            $table->string('phone');
            $table->string('address');
            $table->string('path')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('identification')->unique()->nullable();

            $table->boolean('onlinestatus')->default(false);
            $table->boolean('chatstatus')->default(false);
            $table->string('confirm_token')->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('active_account')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_super_admin')->default(false);
             //$table->tinyInteger('status')->default('1');

        
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
