<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_solicitud');
            $table->foreignId('registro_socio_id')->nullable()->constrained('registro_socios')->onDelete('cascade');
            $table->string('producto');
            $table->string('garantia');
            $table->string('detalle_garantia');
            $table->date('fecha_desembolso');
            $table->string('dni');
            $table->string('asesor');
            $table->string('expediente');
            $table->string('estado');
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
        Schema::dropIfExists('prestamos');
    }
}
