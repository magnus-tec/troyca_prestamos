<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_laboral', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_socio_id')->constrained('registro_socios')->onDelete('cascade');
            $table->enum('situacion', ['independiente', 'dependiente']);
            $table->string('institucion_empresa')->nullable();
            $table->string('direccion_laboral')->nullable();
            $table->string('telefono_laboral')->nullable();
            $table->string('cargo')->nullable();
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
        Schema::dropIfExists('informacion_laboral');
    }
}
