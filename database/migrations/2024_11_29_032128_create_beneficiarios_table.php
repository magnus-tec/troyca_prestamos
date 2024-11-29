<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_socio_id')->constrained('registro_socios')->onDelete('cascade');
            $table->string('apellidos_nombres');
            $table->string('dni', 8);
            $table->date('fecha_nacimiento');
            $table->string('parentesco');
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
        Schema::dropIfExists('beneficiarios');
    }
}
