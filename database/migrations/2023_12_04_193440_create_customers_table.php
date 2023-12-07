<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni', 45)->primary()->comment('Documento de Identidad');
            $table->unsignedBigInteger('id_reg')->comment('ID de la Región del Cliente');
            $table->foreign('id_reg')->references('id_reg')->on('regions');
            $table->unsignedBigInteger('id_com')->comment('ID de la Comuna del Cliente');
            $table->foreign('id_com')->references('id_com')->on('communes');
            $table->string('email', 120)->unique()->comment('Correo Electrónico');
            $table->string('name', 45)->comment('Nombre');
            $table->string('last_name', 45)->comment('Apellido');
            $table->string('address', 255)->nullable()->comment('Dirección');
            $table->dateTime('date_reg')->comment('Fecha y hora del registro');
            $table->enum('status', ['A', 'I', 'trash'])->default('A')->comment('Estado del Cliente: A (Activo), I (Desactiva), trash (Eliminado)');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
