<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommunesTable extends Migration
{
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id('id_com');
            $table->foreignId('id_reg')->constrained('regions', 'id_reg');
            $table->string('description', 90);
            $table->enum('status', ['A', 'I', 'trash'])->default('A');
            $table->index(['id_com', 'id_reg']);
        });

        DB::table('communes')->insert([
            ['id_reg' => 1, 'description' => 'La Plata'],
            ['id_reg' => 1, 'description' => 'Mar del Plata'],
            ['id_reg' => 2, 'description' => 'Córdoba Capital'],
            ['id_reg' => 2, 'description' => 'Villa María'],
            ['id_reg' => 2, 'description' => 'Vílla Carlos Paz'],
            ['id_reg' => 3, 'description' => 'La Capital'],
            ['id_reg' => 3, 'description' => 'Santo Tome'],
            ['id_reg' => 3, 'description' => 'Sauce Viejo'],
            ['id_reg' => 4, 'description' => 'Vílla Mercedes'],
            ['id_reg' => 4, 'description' => 'Merlo'],
            ['id_reg' => 5, 'description' => 'San Rafael'],
            ['id_reg' => 5, 'description' => 'Lujan de Cuyo'],
            ['id_reg' => 6, 'description' => 'Parana'],
            ['id_reg' => 6, 'description' => 'Colon'],
            ['id_reg' => 6, 'description' => 'Diamantes'],
        ]);
    }
    
    public function down()
    {
        Schema::dropIfExists('communes');
    }
}
