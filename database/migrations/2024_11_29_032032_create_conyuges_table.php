<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConyugesTable extends Migration
{
    public function up()
    {
        Schema::create('conyuges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_socio_id')->constrained()->onDelete('cascade');
            $table->string('apellidos_nombres');
            $table->string('dni', 8)->unique();
            $table->date('fecha_nacimiento');
            $table->string('celular')->nullable();
            $table->string('ocupacion');
            $table->string('direccion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conyuges');
    }
}

