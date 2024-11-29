<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_socio_id')->constrained('registro_socios')->onDelete('cascade');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');
            $table->string('dni', 8)->unique();
            $table->date('fecha_nacimiento');
            $table->string('estado_civil');
            $table->string('profesion_ocupacion');
            $table->string('nacionalidad');
            $table->enum('sexo', ['masculino', 'femenino']);
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
        Schema::dropIfExists('datos_personales');
    }
}
