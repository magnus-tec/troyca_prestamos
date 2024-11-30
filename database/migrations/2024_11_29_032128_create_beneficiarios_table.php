<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariosTable extends Migration
{
    public function up()
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_socio_id')->constrained()->onDelete('cascade');
            $table->string('apellidos_nombres');
            $table->string('dni', 8);
            $table->date('fecha_nacimiento');
            $table->string('parentesco');
            $table->enum('sexo', ['masculino', 'femenino']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beneficiarios');
    }
}

