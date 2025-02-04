<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('aplicaciones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('candidato_id');
            $table->uuid('vacante_id');
            $table->string('cv_url', 255);
            $table->enum('estado', ['en proceso', 'contratado', 'rechazado'])->default('en proceso');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('candidato_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('vacante_id')->references('id')->on('vacantes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('aplicaciones');
    }
};
