<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_socio_id')->constrained('registro_socios')->onDelete('cascade');
            $table->string('departamento');
            $table->string('provincia');
            $table->string('distrito');
            $table->enum('tipo_vivienda', ['propia', 'alquilada', 'familiar', 'otro']);
            $table->string('direccion');
            $table->string('referencia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
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
        Schema::dropIfExists('direcciones');
    }
}
