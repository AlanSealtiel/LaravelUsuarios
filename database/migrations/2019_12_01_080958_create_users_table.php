<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id_cliente');
            $table->string('clave', 15)->unique();
            $table->string('nom_com', 100);
            $table->string('raz_soc', 100);
            $table->string('rfc', 13)->unique();
            $table->smallInteger('edad')->nullable();
            $table->string('domicilio', 100)->nullable();
            $table->unsignedSmallInteger('estatus')->nullable();
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

