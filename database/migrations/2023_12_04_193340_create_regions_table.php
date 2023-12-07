<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Region;

class CreateRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id('id_reg');
            $table->string('description', 90);
            $table->enum('status', ['A', 'I', 'trash'])->default('A');
        });

        Region::insert([
            ['description' => 'Buenos Aires'],
            ['description' => 'Córdoba'],
            ['description' => 'Santa Fe'],
            ['description' => 'San Luis'],
            ['description' => 'Mendoza'],
            ['description' => 'Entre Rios'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
}