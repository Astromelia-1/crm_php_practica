<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->text('requisitos');
            $table->uuid('reclutador_id');
            $table->timestamps();

            // Clave foránea
            $table->foreign('reclutador_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vacantes');
    }
};
